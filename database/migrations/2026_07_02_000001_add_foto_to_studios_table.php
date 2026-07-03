public function up(): void
{
    Schema::table('studios', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('status');
    });
}

public function down(): void
{
    Schema::table('studios', function (Blueprint $table) {
        $table->dropColumn('foto');
    });
}