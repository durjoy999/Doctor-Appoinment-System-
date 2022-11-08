<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles
        $roleSuperAdmin = Role::create(['name' => 'SuperAdmin','guard_name' => 'admin']);
        //permission list as array
        $permissions = [

            [
                //dashboard permission
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.index',
                ]
            ],
            [
                //admin permission
                'group_name' => 'admin',
                'permissions' => [
                    'admin.index',
                    'admin.create',
                    'admin.store',
                    'admin.edit',
                    'admin.update',
                    'admin.destroy',
                ]
            ],
            [
                //role permission
                'group_name' => 'role',
                'permissions' => [
                    'role.index',
                    'role.create',
                    'role.store',
                    'role.edit',
                    'role.update',
                    'role.destroy',
                ]
            ],
            [
                //profile permission
                'group_name' => 'profile',
                'permissions' => [
                    'profile.edit',
                    'profile.update'
                ]
            ],
            [
                //general settings permission
                'group_name' => 'settings',
                'permissions' => [
                    'generalSettings.index',
                    'generalSettings.update',
                ]
            ],
            [
                //config settings permission
                'group_name' => 'settings',
                'permissions' => [
                    'configSettings.index',
                    'configSettings.optimizeClear',
                    'configSettings.optimize',
                ]
            ],
            [
                //doctorphoto permission
                'group_name' => 'doctor-photo',
                'permissions' => [
                    'doctorPhotos.all',
                    'doctorPhotos.create',
                    'doctorPhotos.edit',
                    'doctorPhotos.delete',
                ]
            ],
            [
                //doctor myselfs permission
                'group_name' => 'doctormyselfs',
                'permissions' => [
                    'doctormyselfs.all',
                    'doctormyselfs.create',
                    'doctormyselfs.edit',
                    'doctormyselfs.delete',
                ]
            ],
            [
                //Which Hospitals permission
                'group_name' => 'WhichHospitals',
                'permissions' => [
                    'WhichHospitals.all',
                    'WhichHospitals.create',
                    'WhichHospitals.edit',
                    'WhichHospitals.delete',
                ]
            ],
            [
                //educationals permission
                'group_name' => 'educationals',
                'permissions' => [
                    'educationals.all',
                    'educationals.create',
                    'educationals.edit',
                    'educationals.delete',
                ]
            ],
            [
                //Awards Records permission
                'group_name' => 'AwardsRecords',
                'permissions' => [
                    'AwardsRecords.all',
                    'AwardsRecords.create',
                    'AwardsRecords.edit',
                    'AwardsRecords.delete',
                ]
            ],
            [
                //Make Appointments permission
                'group_name' => 'MakeAppointments',
                'permissions' => [
                    'MakeAppointments.all',
                    'MakeAppointments.create',
                    'MakeAppointments.edit',
                    'MakeAppointments.delete',
                ]
            ],
            [
                //schedule Hospitals permission
                'group_name' => 'scheduleHospitals',
                'permissions' => [
                    'scheduleHospitals.all',
                    'scheduleHospitals.create',
                    'scheduleHospitals.edit',
                    'scheduleHospitals.delete',
                ]
            ]

        ];

        //asign permisions
        for($i = 0; $i<count($permissions); $i++){
            $permissionGroup = $permissions[$i]['group_name'];

            for($j = 0; $j<count($permissions[$i]['permissions']); $j++){
                //create permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                    'guard_name' => 'admin'
                ]);

                //assign permission to role
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

    }
}
