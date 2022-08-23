<?php
 namespace App\Services;
 use Illuminate\Support\Facades\Gate;
 use App\Policies\CategoryPolicy;
 use App\Policies\MenuPolicy;
 use App\Policies\ProductPolicy;
 use App\Policies\RolePolicy;
 use App\Policies\SliderPolicy;
 use App\Policies\UserPolicy;

 class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateRole();
        $this->defineGateSlider();
        $this->defineGateUser();
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
 }
