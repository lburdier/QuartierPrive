public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('property_id');
        $table->unsignedBigInteger('user_id');
        $table->text('review');
        $table->integer('rating');
        $table->timestamps();

        $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}
