<?php

$router->group(['prefix' => 'slots'], function () use ($router) {
    $router->post('', ['as' => 'slot_check_in', 'uses' => 'SlotsController@checkIn']);
    $router->delete('{vehicleNumber}', ['as' => 'slot_check_out', 'uses' => 'SlotsController@checkOut']);

    $router->get('free', ['as' => 'free_slots', 'uses' => 'SlotsController@freeSlots']);
    $router->post('amount', ['as' => 'amount_slot', 'uses' => 'SlotsController@checkSlotAmount']);
});
