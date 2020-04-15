<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateNewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginRedirect()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->assertRouteIs('login');
        });
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->assertRouteIs('login')
                ->type('email', 'admin@email.com')
                ->type('password', '123')
                ->press('Вход');
        });
    }

    public function testCreateSuccess() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->type('title', 'Test Name')
                ->type('body', 'test news body')
                ->press('Сохранить')
                ->assertSee('Новость успешно добавлена');
        });
    }

    public function testCreateFailed() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->type('title', 'Test')
                ->press('Сохранить')
                ->assertSee('Количество символов в поле Заголовок должно быть не менее 5.')
                ->assertSee('Поле Тело обязательно для заполнения.');
        });
    }
}
