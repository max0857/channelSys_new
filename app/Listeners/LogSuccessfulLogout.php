<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout{
    /**
     * 创建事件监听器
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 处理事件
     *
     * @return void
     */
    public function handle(Logout $event)
    {
        echo "<script>window.location.href=\"login\";</script>";
        return false;
    }
}
