
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('houses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('site_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->decimal('price', 10, 2);
        $table->string(column: 'property_type');
        $table->boolean(column: 'negotiable');
        $table->string(column: 'owner_contact');
        $table->string(column: 'size');
        $table->string(column: 'area');
        $table->string(column: 'description');
        $table->string('location');
        $table->integer('bedrooms')->nullable();
        $table->integer('bathrooms')->nullable();
        // Other fields...
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};