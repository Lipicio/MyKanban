<?php namespace App\Modules;
 
/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @package App\Modules
*/

class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{




    /**
     * [includeModules Inclui modulos]
     * @param  [array] $modules
     * @return [void]
     */
    private function includeModules($modules) {

        include __DIR__ . '/../../routes/helper.php';

        if(empty($modules)){
            return;
        }

        foreach ($modules as $module){

                // Load the routes for each of the modules
            if(file_exists(__DIR__ . '/' . $module . '/routes.php')) {
                include __DIR__ . '/' . $module . '/routes.php';
            }

                // Load the views
            if(is_dir(__DIR__ . '/' . $module . '/Views')) {
                $this->loadViewsFrom(__DIR__ . '/' . $module . '/Views', $module);
            }

        }
    }

    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     */
    public function boot()
    {
        // For each of the registered modules, include their routes and Views
        \Route::group([
            'middleware' => 'web'
        ], function ($router) {
            $modules = config("module.modules");
            $this->includeModules($modules);

            $modules_mobile = config("module.mobiles");
            $this->includeModules($modules_mobile);
        });



}

    public function register() {}
}
