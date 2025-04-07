public function up()
{
    Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('title');
        $table->text('description');
        $table->string('image')->nullable();
        $table->decimal('price', 10, 2);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}
