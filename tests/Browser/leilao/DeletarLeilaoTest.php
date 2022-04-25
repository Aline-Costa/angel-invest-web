<?php

namespace Tests\Browser\leilao;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeletarLeilaoTest extends DuskTestCase
{
    public function test_deletar_um_leilao()
    {
        $this->browse(function (Browser $browser) {
            $leilao = $this->criar_leilao();
            $this->login($browser, $leilao->proposta->startup->user);
            $browser->visitRoute('leilao.index')
                    ->waitForText('Criar um leilão')
                    ->click('#btnmodaldelete'.$leilao->id)
                    ->waitForText('Tem certeza que deseja deletar o leilão #'.$leilao->id .' do produto '.$leilao->proposta->titulo)
                    ->click('#btnmodaldeleteform'.$leilao->id)
                    ->waitForText('Criar um leilão')
                    ->assertSee('Leilão deletado com sucesso!');
            $this->resetar_session();
        });
    }
}
