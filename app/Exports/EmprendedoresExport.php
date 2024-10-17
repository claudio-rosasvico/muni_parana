<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use App\Models\Emprendedor;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Events\AfterSheet;

class EmprendedoresExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Emprendedor::select('id','nro_expediente', 'anio_expediente', 'apellido', 'nombre', 'telefono', 'email', 'venc_carnet')
            ->get()
            ->map(function ($emprendedor) {
                $nombreEmprendimiento = $emprendedor->emprendimiento->first()->nombre ?? 'Sin Emprendimiento';
                $habilitacion = ($emprendedor->emprendimiento->first()->habilitacion) 
                ? date('d-m-Y', strtotime($emprendedor->emprendimiento->first()->habilitacion)) 
                : 'Sin Habilitación'; 
                Log::info($emprendedor->emprendimiento->first()->productos);
                $productos = $emprendedor->emprendimiento->first()->productos;
                
                return [
                    'nro_expediente' => $emprendedor->nro_expediente,
                    'anio_expediente' => $emprendedor->anio_expediente,
                    'apellido' => $emprendedor->apellido,
                    'nombre' => $emprendedor->nombre,
                    'telefono' => $emprendedor->telefono,
                    'email' => $emprendedor->email,
                    'venc_carnet' => date('d-m-Y', strtotime($emprendedor->venc_carnet))
                    ,
                    'nombre_emprendimiento' => $nombreEmprendimiento,
                    'habilitacion' => $habilitacion,
                    'producto1' => isset($productos[0]) ? $productos[0]->producto->nombre : '',
                    'producto2' => isset($productos[1]) ? $productos[1]->producto->nombre : '',
                    'producto3' => isset($productos[2]) ? $productos[2]->producto->nombre : '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'nro_expediente',
            'anio_expediente',
            'apellido',            
            'nombre',
            'telefono',
            'email',
            'venc_carnet',
            'nombre_emprendimiento',
            'habilitacion',
            'Producto1',
            'Producto2',
            'Producto3',
        ];
    }

    public static function registerEvents(): array {
        return [
            AfterSheet::class => [self::class, 'afterSheet']
        ];
    }

    /* public static function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet->getDelegate();
        
/*         $sheet->getStyle('A:B')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        
        $sheet->getStyle('C:F')->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
        
        $sheet->getProtection()->setSheet(true);
        $sheet->getProtection()->setPassword('my_password'); // Agrega una contraseña si lo deseas 

        $spreadsheet->getActiveSheet()->getStyle('A:B')
    ->getProtection()
    ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED)
    ->setHidden(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
    } */

    public static function afterSheet(AfterSheet $event) {
        $sheet = $event->sheet->getDelegate(); // Obteniendo el objeto de la hoja activa

        // Primero, asegúrate de que las celdas están desbloqueadas
        $sheet->getStyle('A:B')->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);

        // Luego, protege las celdas de las columnas A y B
        $sheet->getStyle('A:B')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);

        // Finalmente, activa la protección de la hoja
        $sheet->getProtection()->setSheet(true);
    }
    
}
