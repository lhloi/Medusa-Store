<?php
 namespace App\Services;
 use Illuminate\Support\Facades\Gate;
 use App\Policies\CategoryPolicy;
 use App\Policies\MenuPolicy;
 use App\Policies\ProductPolicy;
 use App\Policies\RolePolicy;
 use App\Policies\SliderPolicy;
 use App\Policies\UserPolicy;
 use App\Policies\ColorPolicy;
 use App\Policies\SizePolicy;
 use App\Policies\CouponPolicy;
 use App\Policies\BrandPolicy;
 use App\Policies\OrderPolicy;

 class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateRole();
        $this->defineGateSlider();
        $this->defineGateUser();
        $this->defineGateColor();
        $this->defineGateSize();
        $this->defineGateCoupon();
        $this->defineGateBrand();
        $this->defineGateOrder();
    }

    public function defineGateCategory()
    {
        Gate::define('list-category', [CategoryPolicy::class,'view']);
        Gate::define('add-category', [CategoryPolicy::class,'create']);
        Gate::define('edit-category', [CategoryPolicy::class,'update']);
        Gate::define('delete-category', [CategoryPolicy::class,'delete']);
    }
    public function defineGateMenu()
    {
        Gate::define('list-menu', [MenuPolicy::class,'view']);
        Gate::define('add-menu', [MenuPolicy::class,'create']);
        Gate::define('edit-menu', [MenuPolicy::class,'update']);
        Gate::define('delete-menu', [MenuPolicy::class,'delete']);
    }
    public function defineGateProduct()
    {
        Gate::define('list-product', [ProductPolicy::class,'view']);
        Gate::define('add-product', [ProductPolicy::class,'create']);
        Gate::define('edit-product', [ProductPolicy::class,'update']);
        Gate::define('delete-product', [ProductPolicy::class,'delete']);
    }
    public function defineGateRole()
    {
        Gate::define('list-role', [RolePolicy::class,'view']);
        Gate::define('add-role', [RolePolicy::class,'create']);
        Gate::define('edit-role', [RolePolicy::class,'update']);
        Gate::define('delete-role', [RolePolicy::class,'delete']);
    }
    public function defineGateSlider()
    {
        Gate::define('list-slider', [SliderPolicy::class,'view']);
        Gate::define('add-slider', [SliderPolicy::class,'create']);
        Gate::define('edit-slider', [SliderPolicy::class,'update']);
        Gate::define('delete-slider', [SliderPolicy::class,'delete']);
    }
    public function defineGateUser()
    {
        Gate::define('list-user', [UserPolicy::class,'view']);
        Gate::define('add-user', [UserPolicy::class,'create']);
        Gate::define('edit-user', [UserPolicy::class,'update']);
        Gate::define('delete-user', [UserPolicy::class,'delete']);
    }
    public function defineGateColor()
    {
        Gate::define('list-product-color', [ColorPolicy::class,'view']);
        Gate::define('add-product-color', [ColorPolicy::class,'create']);
        Gate::define('edit-product-color', [ColorPolicy::class,'update']);
        Gate::define('delete-product-color', [ColorPolicy::class,'delete']);
    }
    public function defineGateSize()
    {
        Gate::define('list-product-size', [SizePolicy::class,'view']);
        Gate::define('add-product-size', [SizePolicy::class,'create']);
        Gate::define('edit-product-size', [SizePolicy::class,'update']);
        Gate::define('delete-product-size', [SizePolicy::class,'delete']);
    }
    public function defineGateCoupon()
    {
        Gate::define('list-coupon', [CouponPolicy::class,'view']);
        Gate::define('add-coupon', [CouponPolicy::class,'create']);
        Gate::define('edit-coupon', [CouponPolicy::class,'update']);
        Gate::define('delete-coupon', [CouponPolicy::class,'delete']);
    }
    public function defineGateBrand()
    {
        Gate::define('list-brand', [BrandPolicy::class,'view']);
        Gate::define('add-brand', [BrandPolicy::class,'create']);
        Gate::define('edit-brand', [BrandPolicy::class,'update']);
        Gate::define('delete-brand', [BrandPolicy::class,'delete']);
    }
    public function defineGateOrder()
    {
        Gate::define('list-order', [OrderPolicy::class,'view']);
        Gate::define('add-order', [OrderPolicy::class,'create']);
        Gate::define('edit-order', [OrderPolicy::class,'update']);
        Gate::define('delete-order', [OrderPolicy::class,'delete']);
    }

 }
