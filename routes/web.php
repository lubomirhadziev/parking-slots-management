<?php

$router->group(['prefix' => 'slots'], function () use ($router) {
    $router->get('free', ['as' => 'free_slots', 'uses' => 'SlotsController@freeSlots']);
    $router->post('amount', ['as' => 'amount_slot', 'uses' => 'SlotsController@checkSlotAmount']);
});
