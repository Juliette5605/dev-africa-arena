<?php
namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Candidature;
class CandidatureTest extends TestCase {
    use RefreshDatabase;
    public function test_candidature_can_be_created(): void {
        $c = Candidature::create([
            'nom'=>'Dupont','prenom'=>'Jean','email'=>'jean@test.com',
            'age'=>25,'niveau'=>'Junior','pays'=>'Togo',
            'expertise'=>'Web','diplome'=>'Licence','motivation'=>str_repeat('a',50),'vision'=>str_repeat('b',30)
        ]);
        $this->assertDatabaseHas('candidatures',['email'=>'jean@test.com']);
    }
}
