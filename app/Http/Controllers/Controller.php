<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Sanitize input from web forms to remove html special chars
     * @param string|array $input
     * @return string|array
     */
    public function sanitize($input)
    {
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                $input[$key] = $this->sanitize($val);
            }
        } else {
            $input = filter_var($input, FILTER_SANITIZE_STRING);
        }
        return $input;
    }
}
