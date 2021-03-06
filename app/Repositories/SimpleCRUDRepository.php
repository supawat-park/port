<?php
namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Items;
use App\Repositories\BaseRepository;
use DB;
use Exception;
use Session;

class SimpleCRUDRepository extends BaseRepository
{
    const MODEL = Items::class;
    protected $model;

    public function getLineData()
    {
        $data = Items::where('is_active', 1)
            ->get();
        return $data;
    }

    public function insertLineData($input)
    {
        try {
            DB::transaction(function () use ($input) {
                $itemDetail = Items::class;
                $itemDetail = new $itemDetail();
                $itemDetail->name = $input['nameModel'];
                $itemDetail->quantity = $input['quantityModel'];
                $itemDetail->is_active = 1;
                $itemDetail->save();
            });
            return 'true';
        } catch (Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }
    public function selectLineData($lineId = 1)
    {
        $data = Items::where('id', $lineId)
            ->first();
        return $data;
    }

    public function updateLineData($input)
    {
        try {
            DB::transaction(function () use ($input) {
                $itemDetail = Items::where('id', $input['idModel'])->first();
                $itemDetail->name = $input['nameModel'];
                $itemDetail->quantity = $input['quantityModel'];
                $itemDetail->save();
            });
            return 'true';
        } catch (Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    public function deleteLineData($lineId = "")
    {
            try
            {
                DB::transaction(function () use ($lineId) {
                    $itemDetail = Items::where('id', $lineId)->first();
                    $itemDetail->is_active = 0;
                    $itemDetail->save();
                });
            } catch (Exception $e) {
                throw new GeneralException($e->getMessage());
            }
    }


}
