<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Product $product): bool
    {
        return $product->is_active || $user?->hasRole('admin', 'editor') === true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'editor');
    }

    public function update(User $user, Product $product): bool
    {
        return $user->hasRole('admin')
            || ($user->hasRole('editor') && $product->created_by === $user->id);
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}
