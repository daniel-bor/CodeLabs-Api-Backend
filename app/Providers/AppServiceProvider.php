<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('codigo_solicitud', function ($attribute, $value, $parameters, $validator) {
            // La lógica de validación personalizada aquí
            return preg_match('/^(EX|IN)-\d{8}-\d{5}$/', $value);
        });

        // Validación de número de expediente para el siguiente formato: 7590-22-14705 (12 dígitoss)
        Validator::extend('numero_expediente', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\d{4}-\d{2}-\d{5}$/', $value);
        });

        Validator::extend('fecha_creacion', function ($attribute, $value, $parameters, $validator) {
            // Divide la cadena en dos partes usando el guion como separador
            $partes = explode('-', $value);

            // Verifica que haya dos partes
            if (count($partes) != 2) {
                return false;
            }

            // Define una expresión regular para el formato "dd/mm/yyyy"
            $regex = '/^\d{2}\/\d{2}\/\d{4}$/';

            // Verifica que ambas partes cumplan con el formato
            if (!preg_match($regex, $partes[0]) || !preg_match($regex, $partes[1])) {
                return false;
            }

            // Convierte las partes a objetos DateTime para comparar fechas
            $fechaInferior = \DateTime::createFromFormat('d/m/Y', $partes[0]);
            $fechaSuperior = \DateTime::createFromFormat('d/m/Y', $partes[1]);
            $fechaActual = new \DateTime();

            // La fecha inferior no puede ser mayor a la fecha superior
            if ($fechaInferior > $fechaSuperior) {
                return false;
            }

            // La fecha superior no puede ser mayor a la fecha actual
            if ($fechaSuperior > $fechaActual) {
                return false;
            }

            // La diferencia de las fechas no debe de exceder un año
            $diferencia = $fechaSuperior->diff($fechaInferior);
            if ($diferencia->y > 0) {
                return false;
            }

            return true;
        });

        Validator::extend('usuario_asignacion', function ($attribute, $value, $parameters, $validator) {
            // La lógica de validación personalizada aquí
            return preg_match('/^[a-zA-Z]{8,12}$/', $value);
        });

    }
}
