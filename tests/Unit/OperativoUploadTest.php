<?php

namespace Tests\Unit;

use App\Models\Operativo;
use App\Models\Upload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OperativoUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_observaciones_column_and_pivot_table_exist(): void
    {
        $this->assertTrue(Schema::hasColumn('operativos', 'observaciones'));
        $this->assertTrue(Schema::hasTable('operativo_upload'));
    }

    public function test_operativo_can_attach_upload(): void
    {
        $operativo = Operativo::create([
            'titulo' => 'Operativo',
            'descripcion' => 'Desc',
            'fecha_inicio' => now(),
            'fecha_termino' => now(),
        ]);

        $upload = Upload::create([
            'filename' => 'file.txt',
            'url' => '/file.txt',
            'mime_type' => 'text/plain',
            'size' => 1,
        ]);

        $operativo->uploads()->attach($upload->id);

        $this->assertDatabaseHas('operativo_upload', [
            'operativo_id' => $operativo->id,
            'upload_id' => $upload->id,
        ]);
    }
}
