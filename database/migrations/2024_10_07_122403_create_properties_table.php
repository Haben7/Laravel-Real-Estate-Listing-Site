<!-- <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id'); // Foreign key to owner
            $table->string('title'); // Corrected from property_title to title
            $table->string('location'); // Address, City, State, Zip
            $table->text('short_description')->nullable(); // Made short_description nullable
            $table->enum('property_type', ['House', 'Apartment', 'Condo', 'Land', 'Commercial Space']);
            $table->enum('listing_type', ['For Sale', 'For Rent', 'Lease']);
            $table->decimal('price', 15, 2);
            $table->boolean('negotiable')->default(false);
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            // $table->integer('garage')->nullable(); // Allow null values
            $table->integer('floors')->nullable();
            $table->decimal('lot_size', 10, 2)->nullable();
            $table->boolean('has_pool')->default(false);
            $table->string('heating_system')->nullable();
            $table->string('cooling_system')->nullable();
            $table->string('furnishing_status')->nullable();
            $table->enum('condition', ['New', 'Like New', 'Needs Renovation'])->nullable(); // Added nullable option
            $table->string('ownership_type')->nullable(); // Added ownership_type field
            $table->string('title_status')->nullable(); // Added title_status field
            $table->string('zoning')->nullable(); // Added zoning field
            $table->string('building_permits')->nullable(); // Added building_permits field
            $table->string('mortgage_status')->nullable(); // Added mortgage_status field
            $table->boolean('balcony')->nullable(); // Added balcony field
            $table->boolean('garden')->nullable(); // Added garden field
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
