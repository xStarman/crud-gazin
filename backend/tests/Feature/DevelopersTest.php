<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\Developer;


class DevelopersTest extends TestCase
{

    public function testHealthy()
    {
        $response = $this->get("/");
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->json('POST', '/developers', ['datanascimento' => '1995-02-23', 'sexo' => 'M', "nome" => "edson alves de oliveira junior", "hobby" => "jogos online"]);
        $response->assertStatus(201)->assertJsonStructure(["id", "datanascimento", "sexo", "nome", "hobby", "idade", "updated_at", "created_at"]);
        $responseData = $response->getData();
        $createdId = $responseData->id;
       

        // echo "response >> " . $response->getContent();die;

        $response = $this->json('POST', '/developers', []);
        $response->assertStatus(400)->assertJsonStructure(["nome" => [], "sexo" => [], "hobby" => [], "datanascimento" => []]);

        // echo "response >> " . $response->getContent();die;

        return $createdId;
    }

    /**
     * @depends testCreate
     */
    public function testEdit($createdId)
    {
        $response = $this->json('PUT', "/developers/$createdId", ['datanascimento' => '1995-02-23', 'sexo' => 'F', "nome" => "edson alves de oliveira junior", "hobby" => "jogos online"]);
        $response->assertStatus(204);

        $response = $this->json('GET',  "/developers/$createdId");

        $response->assertStatus(200)->assertJson([
            'sexo' => "F",
        ]);

        // echo "response >> " . $response->getContent();die;

        $response = $this->json('PUT', "/developers/$createdId", []);
        $response->assertStatus(400)->assertJsonStructure(["nome" => [], "sexo" => [], "hobby" => [], "datanascimento" => []]);

        // echo "response >> " . $response->getContent();die;

    }

    /**
     * @depends testCreate
     */
    public function testList($createdId)
    {
        $response = $this->json('GET', "/developers/$createdId");
        $response->assertStatus(200)->assertJsonStructure(["id", "datanascimento", "sexo", "nome", "hobby", "idade", "updated_at", "created_at"]);

        // echo "response >> " . $response->getContent();die;

        $response = $this->json('GET', "/developers");
        $response->assertStatus(200)->assertJsonStructure(["data" => [["id", "datanascimento", "sexo", "nome", "hobby", "idade", "updated_at", "created_at"]], "current_page", "total"]);

        // echo "response >> " . $response->getContent();die;

        $response = $this->json('GET', "/developers/-1");
        $response->assertStatus(404);
    }

    /**
     * @depends testCreate
     */
    public function testDelete($createdId)
    {
        $response = $this->json('DELETE', "/developers/$createdId");
        $response->assertStatus(204);

        $response = $this->json('DELETE', "/developers/-1");
        $response->assertStatus(400)->assertJsonStructure(["id" => []]);
    }
}
