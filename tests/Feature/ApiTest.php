<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ApiTest extends TestCase
{
    private array $data = [
        'eventTitle' => 'test',
        'eventDate' => '01.01.1970',
        'eventCity' => 'Mannheim',
        'tickets' => [
            [
                'barcode' => 'test123',
                'firstName' => 'test',
                'lastName' => 'test'
            ]
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('events')->truncate();
        DB::table('tickets')->truncate();
        Event::create($this->data)
            ->tickets()
            ->save(new Ticket($this->data['tickets'][0]));
    }

    public function testStore()
    {
        $response = $this
            ->post('/api/event', $this->data)
            ->assertOk()
            ->decodeResponseJson();
        $this->assertArrayValues($response['event']);
    }

    public function testShow()
    {
        $response = $this
            ->get('/api/event/1')
            ->assertOk()
            ->decodeResponseJson();
        $this->assertArrayValues($response['event']);
    }

    public function testDestroy()
    {
        $this->assertDatabaseCount(Event::class, 1);
        $this->assertDatabaseCount(Ticket::class, 1);
        $this
            ->delete('/api/event/1')
            ->assertOk();
        $this->assertDatabaseCount(Event::class, 0);
        $this->assertDatabaseCount(Ticket::class, 0);
    }

    public function testUpdate()
    {
        $data = $this->data;
        $data['eventTitle'] = 'changed';
        $response = $this
            ->put('/api/event/1', $data)
            ->assertOk()
            ->decodeResponseJson();
        $this->assertEquals($response['event']['eventTitle'], 'changed');
    }

    public function testIndex()
    {
        $response = $this
            ->get('/api/event')
            ->assertOk()
            ->decodeResponseJson();
        $this->assertCount(1, $response['events']);
        $this->assertArrayValues($response['events'][0]);
    }

    private function assertArrayValues(array $event)
    {
        foreach ($this->data as $key => $value) {
            if ($key !== 'tickets') {
                $this->assertEquals($value, $event[$key]);
            } else {
                foreach ($this->data['tickets'][0] as $ticketKey => $ticketValue) {
                    $this->assertEquals($ticketValue, $event['tickets'][0][$ticketKey]);
                }
            }
        }
    }
}