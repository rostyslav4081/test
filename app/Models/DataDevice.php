<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Eloquent model for `data_device` table.
 * Primary key: id
 */
class DataDevice extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_device';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the related SysLocation for this record.
     */
    public function sysLocation(): BelongsTo
    {
        return $this->belongsTo(SysLocation::class, 'locationId');
    }

    /**
     * Get related DataAcs20history records.
     */
    public function dataAcs20history(): HasMany
    {
        return $this->hasMany(DataAcs20history::class, 'deviceId');
    }

    /**
     * Get related DataAcs20historyElmeter1h records.
     */
    public function dataAcs20historyElmeter1h(): HasMany
    {
        return $this->hasMany(DataAcs20historyElmeter1h::class, 'deviceId');
    }

    /**
     * Get related DataAcs20info records.
     */
    public function dataAcs20info(): HasMany
    {
        return $this->hasMany(DataAcs20info::class, 'deviceId');
    }

    /**
     * Get related DataAcs20mpgHistory records.
     */
    public function dataAcs20mpgHistory(): HasMany
    {
        return $this->hasMany(DataAcs20mpgHistory::class, 'deviceId');
    }

    /**
     * Get related DataAcs20mpgInfo records.
     */
    public function dataAcs20mpgInfo(): HasMany
    {
        return $this->hasMany(DataAcs20mpgInfo::class, 'deviceId');
    }

    /**
     * Get related DataBatInfo records.
     */
    public function dataBatInfo(): HasMany
    {
        return $this->hasMany(DataBatInfo::class, 'deviceId');
    }

    /**
     * Get related DataBrmHistory records.
     */
    public function dataBrmHistory(): HasMany
    {
        return $this->hasMany(DataBrmHistory::class, 'deviceId');
    }

    /**
     * Get related DataBrmHistoryElmeter1h records.
     */
    public function dataBrmHistoryElmeter1h(): HasMany
    {
        return $this->hasMany(DataBrmHistoryElmeter1h::class, 'deviceId');
    }

    /**
     * Get related DataBrmInfo records.
     */
    public function dataBrmInfo(): HasMany
    {
        return $this->hasMany(DataBrmInfo::class, 'deviceId');
    }

    /**
     * Get related DataBusHistory records.
     */
    public function dataBusHistory(): HasMany
    {
        return $this->hasMany(DataBusHistory::class, 'deviceId');
    }

    /**
     * Get related DataBusHistoryElmeter1h records.
     */
    public function dataBusHistoryElmeter1h(): HasMany
    {
        return $this->hasMany(DataBusHistoryElmeter1h::class, 'deviceId');
    }

    /**
     * Get related DataBusInfo records.
     */
    public function dataBusInfo(): HasMany
    {
        return $this->hasMany(DataBusInfo::class, 'deviceId');
    }

    /**
     * Get related DataBusMpgHistory records.
     */
    public function dataBusMpgHistory(): HasMany
    {
        return $this->hasMany(DataBusMpgHistory::class, 'deviceId');
    }

    /**
     * Get related DataBusMpgInfo records.
     */
    public function dataBusMpgInfo(): HasMany
    {
        return $this->hasMany(DataBusMpgInfo::class, 'deviceId');
    }

    /**
     * Get related DataDcs19history records.
     */
    public function dataDcs19history(): HasMany
    {
        return $this->hasMany(DataDcs19history::class, 'deviceId');
    }

    /**
     * Get related DataDcs19historyElmeter1h records.
     */
    public function dataDcs19historyElmeter1h(): HasMany
    {
        return $this->hasMany(DataDcs19historyElmeter1h::class, 'deviceId');
    }

    /**
     * Get related DataDcs19info records.
     */
    public function dataDcs19info(): HasMany
    {
        return $this->hasMany(DataDcs19info::class, 'deviceId');
    }

    /**
     * Get related DataDcs19mpgHistory records.
     */
    public function dataDcs19mpgHistory(): HasMany
    {
        return $this->hasMany(DataDcs19mpgHistory::class, 'deviceId');
    }

    /**
     * Get related DataDcs19mpgInfo records.
     */
    public function dataDcs19mpgInfo(): HasMany
    {
        return $this->hasMany(DataDcs19mpgInfo::class, 'deviceId');
    }

    /**
     * Get related DataDcsHistory records.
     */
    public function dataDcsHistory(): HasMany
    {
        return $this->hasMany(DataDcsHistory::class, 'deviceId');
    }

    /**
     * Get related DataDcsHistoryElmeter1h records.
     */
    public function dataDcsHistoryElmeter1h(): HasMany
    {
        return $this->hasMany(DataDcsHistoryElmeter1h::class, 'deviceId');
    }

    /**
     * Get related DataDcsHistoryHistR records.
     */
    public function dataDcsHistoryHistR(): HasMany
    {
        return $this->hasMany(DataDcsHistoryHistR::class, 'deviceId');
    }

    /**
     * Get related DataDcsInfo records.
     */
    public function dataDcsInfo(): HasMany
    {
        return $this->hasMany(DataDcsInfo::class, 'deviceId');
    }

    /**
     * Get related DataDcsInfoHistR records.
     */
    public function dataDcsInfoHistR(): HasMany
    {
        return $this->hasMany(DataDcsInfoHistR::class, 'deviceId');
    }

    /**
     * Get related DataDeviceGps records.
     */
    public function dataDeviceGps(): HasMany
    {
        return $this->hasMany(DataDeviceGps::class, 'deviceId');
    }

    /**
     * Get related DataEspHistory records.
     */
    public function dataEspHistory(): HasMany
    {
        return $this->hasMany(DataEspHistory::class, 'deviceId');
    }

    /**
     * Get related DataEspInfo records.
     */
    public function dataEspInfo(): HasMany
    {
        return $this->hasMany(DataEspInfo::class, 'deviceId');
    }

    /**
     * Get related DataEvoHistory records.
     */
    public function dataEvoHistory(): HasMany
    {
        return $this->hasMany(DataEvoHistory::class, 'deviceId');
    }

    /**
     * Get related DataEvoHistoryElmeter records.
     */
    public function dataEvoHistoryElmeter(): HasMany
    {
        return $this->hasMany(DataEvoHistoryElmeter::class, 'deviceId');
    }

    /**
     * Get related DataEvoInfo records.
     */
    public function dataEvoInfo(): HasMany
    {
        return $this->hasMany(DataEvoInfo::class, 'deviceId');
    }

    /**
     * Get related DataNetData records.
     */
    public function dataNetData(): HasMany
    {
        return $this->hasMany(DataNetData::class, 'id');
    }

    /**
     * Get related DataRnsAcHistory records.
     */
    public function dataRnsAcHistory(): HasMany
    {
        return $this->hasMany(DataRnsAcHistory::class, 'deviceId');
    }

    /**
     * Get related DataRnsAcHistoryElmeter records.
     */
    public function dataRnsAcHistoryElmeter(): HasMany
    {
        return $this->hasMany(DataRnsAcHistoryElmeter::class, 'deviceId');
    }

    /**
     * Get related DataRnsAcInfo records.
     */
    public function dataRnsAcInfo(): HasMany
    {
        return $this->hasMany(DataRnsAcInfo::class, 'deviceId');
    }

    /**
     * Get related DataRnsHistory records.
     */
    public function dataRnsHistory(): HasMany
    {
        return $this->hasMany(DataRnsHistory::class, 'deviceId');
    }

    /**
     * Get related DataRnsHistoryElmeter records.
     */
    public function dataRnsHistoryElmeter(): HasMany
    {
        return $this->hasMany(DataRnsHistoryElmeter::class, 'deviceId');
    }

    /**
     * Get related DataRnsInfo records.
     */
    public function dataRnsInfo(): HasMany
    {
        return $this->hasMany(DataRnsInfo::class, 'deviceId');
    }

    /**
     * Get related DataRosHistory records.
     */
    public function dataRosHistory(): HasMany
    {
        return $this->hasMany(DataRosHistory::class, 'deviceId');
    }

    /**
     * Get related DataRosHistoryElmeter records.
     */
    public function dataRosHistoryElmeter(): HasMany
    {
        return $this->hasMany(DataRosHistoryElmeter::class, 'deviceId');
    }

    /**
     * Get related DataRosInfo records.
     */
    public function dataRosInfo(): HasMany
    {
        return $this->hasMany(DataRosInfo::class, 'deviceId');
    }

    /**
     * Get related DataRrdHistory records.
     */
    public function dataRrdHistory(): HasMany
    {
        return $this->hasMany(DataRrdHistory::class, 'deviceId');
    }

    /**
     * Get related DataRrdInfo records.
     */
    public function dataRrdInfo(): HasMany
    {
        return $this->hasMany(DataRrdInfo::class, 'deviceId');
    }

    /**
     * Get related DataRrdMbHistory records.
     */
    public function dataRrdMbHistory(): HasMany
    {
        return $this->hasMany(DataRrdMbHistory::class, 'deviceId');
    }

    /**
     * Get related DataRrdMbHistoryElmeter records.
     */
    public function dataRrdMbHistoryElmeter(): HasMany
    {
        return $this->hasMany(DataRrdMbHistoryElmeter::class, 'deviceId');
    }

    /**
     * Get related DataRrdMbInfo records.
     */
    public function dataRrdMbInfo(): HasMany
    {
        return $this->hasMany(DataRrdMbInfo::class, 'deviceId');
    }

    /**
     * Get related DataTnbHistory records.
     */
    public function dataTnbHistory(): HasMany
    {
        return $this->hasMany(DataTnbHistory::class, 'deviceId');
    }

    /**
     * Get related DataTnbHistoryElmeter records.
     */
    public function dataTnbHistoryElmeter(): HasMany
    {
        return $this->hasMany(DataTnbHistoryElmeter::class, 'deviceId');
    }

    /**
     * Get related DataTnbHistoryHistR records.
     */
    public function dataTnbHistoryHistR(): HasMany
    {
        return $this->hasMany(DataTnbHistoryHistR::class, 'deviceId');
    }

    /**
     * Get related DataTnbInfo records.
     */
    public function dataTnbInfo(): HasMany
    {
        return $this->hasMany(DataTnbInfo::class, 'deviceId');
    }

    /**
     * Get related DataTnsInfo records.
     */
    public function dataTnsInfo(): HasMany
    {
        return $this->hasMany(DataTnsInfo::class, 'deviceId');
    }

    /**
     * Get related DataTnsInfoHistR records.
     */
    public function dataTnsInfoHistR(): HasMany
    {
        return $this->hasMany(DataTnsInfoHistR::class, 'deviceId');
    }

    /**
     * Get related DataTramDchistory records.
     */
    public function dataTramDchistory(): HasMany
    {
        return $this->hasMany(DataTramDchistory::class, 'deviceId');
    }

    /**
     * Get related DataTramDchistoryElmeter1h records.
     */
    public function dataTramDchistoryElmeter1h(): HasMany
    {
        return $this->hasMany(DataTramDchistoryElmeter1h::class, 'deviceId');
    }

    /**
     * Get related DataTramDcinfo records.
     */
    public function dataTramDcinfo(): HasMany
    {
        return $this->hasMany(DataTramDcinfo::class, 'deviceId');
    }

    /**
     * Get related SysEvent records.
     */
    public function sysEvent(): HasMany
    {
        return $this->hasMany(SysEvent::class, 'deviceId');
    }

    /**
     * Get related SysNotification records.
     */
    public function sysNotification(): HasMany
    {
        return $this->hasMany(SysNotification::class, 'deviceId');
    }

    /**
     * Get related SysNotificationSetting records.
     */
    public function sysNotificationSetting(): HasMany
    {
        return $this->hasMany(SysNotificationSetting::class, 'deviceId');
    }

    /**
     * Get related SysSnmpFetchConf records.
     */
    public function sysSnmpFetchConf(): HasMany
    {
        return $this->hasMany(SysSnmpFetchConf::class, 'deviceId');
    }

}