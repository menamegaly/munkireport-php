<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use MR\Scopes\CreatedSinceScope;

class Machine extends Model
{
    protected $table = 'machine';

    protected $fillable
        = [
            'hostname',
            'machine_model',
            'machine_desc',
            'img_url',
            'cpu',
            'current_processor_speed',
            'cpu_arch',
            'os_version',
            'physical_memory',
            'platform_UUID',
            'number_processors',
            'SMC_version_system',
            'boot_rom_version',
            'bus_speed',
            'computer_name',
            'l2_cache',
            'machine_name',
            'packages',
            'buildversion'
        ];

    protected $casts = [
        'number_processors' => 'integer'
    ];

    public function getRouteKeyName()
    {
        return 'serial_number';
    }

    //// RELATIONSHIPS

    /**
     * Get events generated by this machine
     */
    public function events()
    {
        return $this->hasMany('MR\Event', 'serial_number', 'serial_number');
    }

    /**
     * Get report data submitted by this machine
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reportData()
    {
        return $this->hasOne('MR\ReportData', 'serial_number', 'serial_number');
    }

    /**
     * Get comment(s) associated with this machine
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('MR\Comment', 'serial_number', 'serial_number');
    }

    /**
     * Get a list of machine groups this machine is part of through the
     * `report_data` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function machineGroups() {
        return $this->hasManyThrough(
            'App\MachineGroup', 'MR\ReportData',
            'serial_number', 'id', 'serial_number'
        );
    }

    //// SCOPES
    use CreatedSinceScope;
}
