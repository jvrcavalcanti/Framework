<?php

use Accolon\Migration\Migration;
use Accolon\Migration\Schema;
use Accolon\Migration\Blueprint;

class className implements Migration
{
    private string $table = "%name%";
    
    public function up()
    {
        return Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down()
    {
        return Schema::dropIfExists($this->table);
    }
}