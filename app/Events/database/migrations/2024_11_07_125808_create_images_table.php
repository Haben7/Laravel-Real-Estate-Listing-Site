

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained()->onDelete('cascade'); // Assuming a property can have multiple images
            $table->string('path'); // Path to the image file
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
