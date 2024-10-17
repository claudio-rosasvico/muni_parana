<?php

namespace App\Imports;

use App\Models\Emprendedor;
use App\Models\Emprendimiento;
use DateTime;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmprendedoresImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $emprendedor = Emprendedor::where('nro_expediente', $row['nro_expediente'])
            ->where('anio_expediente', $row['anio_expediente'])
            ->first();
        $fechas = [$row['venc_carnet'], $row['habilitacion']];
        foreach ($fechas as $index => $valor) {
            if (is_int($valor)) {
                $fechas[$index] = Date::excelToDateTimeObject($valor);
            } else {
                $date = DateTime::createFromFormat('d-m-Y', $valor);
                if ($date) {
                    $fechas[$index] = $date->format('Y-m-d');
                } else {
                    return redirect()->back()->with('error', 'Formato de fecha incorrecto');
                }
            }
        }

        if ($emprendedor) {

            $emprendedor->apellido = $row['apellido'];
            $emprendedor->nombre = $row['nombre'];
            $emprendedor->telefono = $row['telefono'];
            $emprendedor->email = $row['email'];
            $emprendedor->venc_carnet = $fechas[0];
            $emprendedor->save();

            $emprendimiento = $emprendedor->emprendimiento->first();

            $emprendimiento->nombre = $row['nombre_emprendimiento'];
            $emprendimiento->habilitacion = $fechas[1];
            $emprendimiento->save();
        } else {

            $emprendedor = Emprendedor::create([
                'nro_expediente' => $row['nro_expediente'],
                'anio_expediente' => $row['anio_expediente'],
                'apellido' => $row['apellido'],
                'nombre' => $row['nombre'],
                'telefono' => $row['telefono'],
                'email' => $row['email'],
                'venc_carnet' => $fechas[0],
                'user_id' => auth()->user()->id
            ]);

            $emprendimiento = Emprendimiento::create([
                'emprendedor_id' => $emprendedor->id,
                'nombre' => $row['nombre_emprendimiento'],
                'habilitacion' => $fechas[1]
            ]);

        }
    }

    public function rules(): array
    {
        return [
            '*.nro_expediente' => 'required',
            '*.anio_expediente' => 'required',
            '*.apellido' => 'required',
            '*.nombre' => 'required',
            '*.telefono' => 'nullable',
            '*.email' => 'nullable|email',
            '*.venc_carnet' => 'nullable|date',
        ];
    }
}
