<?php

declare(strict_types=1);

use App\Http\Livewire\Currency\Edit;
use Livewire\Livewire;
use App\Models\Currency;

use function Pest\Laravel\assertDatabaseHas;

it('test the currency edit if working', function () {
    $this->withoutExceptionHandling();
    $this->loginAsAdmin();

    Livewire::test(Edit::class)
        ->assertOk()
        ->assertViewIs('livewire.currency.edit');
});

it('tests the update currency can component', function () {
    $this->loginAsAdmin();

    $currency = Currency::factory()->create();

    Livewire::test(Edit::class, ['id' => $currency->id])
        ->set('currency.name', 'Us Dollar')
        ->set('currency.code', 'USD')
        ->set('currency.symbol', '$')
        ->set('currency.exchange_rate', '1')
        ->call('update')
        ->assertHasNoErrors();

    assertDatabaseHas('currencies', [
        'name'          => 'Us Dollar',
        'code'          => 'USD',
        'symbol'        => '$',
        'exchange_rate' => '1',
    ]);
});

it('tests the edit user component validation', function () {
    $this->withoutExceptionHandling();
    $this->loginAsAdmin();

    $currency = Currency::factory()->create();

    Livewire::test(Edit::class, ['id' => $currency->id])
        ->set('currency.name', '')
        ->set('currency.code', '')
        ->set('currency.symbol', '')
        ->set('currency.exchange_rate', '')
        ->call('update')
        ->assertHasErrors(
            ['currency.name' => 'required'],
            ['currency.code'          => 'required'],
            ['currency.symbol'        => 'required'],
            ['currency.exchange_rate' => 'required'],
        );
});
