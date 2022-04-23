<?php

namespace Tests\Feature\leilao;

class DeleteLeilaoTest extends LeilaoTest
{
    public function test_deletar_um_leilao_existente()
    {
        $leilao = $this->criar_leilao();
        $response = $this->delete(route('leilao.destroy', $leilao));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Leilão deletado com sucesso!');
    }

    public function test_deletar_um_leilao_inexistente()
    {
        $leilao = $this->criar_leilao();
        $response = $this->delete(route('leilao.destroy', $leilao->id + 1));

        $response->assertStatus(403);
    }
}
