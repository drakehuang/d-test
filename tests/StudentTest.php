<?php

class StudentTest extends TestCase {

// a. 測試
    public function testShow()
    {
        $request = $this->call('GET', '/assignments/api/v1/students/1');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(5, $data['data']);
        $this->assertArrayHasKey('id', $data['data']);
        $this->assertArrayHasKey('name', $data['data']);
        $this->assertArrayHasKey('birthday', $data['data']);
        $this->assertArrayHasKey('registerDate', $data['data']);
        $this->assertArrayHasKey('remark', $data['data']);
    }

    public function testWithoutshow()
    {
        $request = $this->call('GET', '/assignments/api/v1/students/500');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('data', $data);
        $this->assertNull($data['data']);
    }

    public function testWrongFormatShow()
    {
        $request = $this->call('GET', '/assignments/api/v1/students/測試');
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The id must be integer.');
    }

// b. 測試
    public function testWithoutParamSearch()
    {
        $request = $this->call('POST', '/assignments/api/v1/students/r');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(20, $data['data']);
    }

    public function testWrongFormatSearch()
    {
        $postData['id'] = 'Drake';
        $request = $this->call('POST', '/assignments/api/v1/students/r', $postData);
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The id must be an integer.');
        unset($postData, $request, $response, $data);

        $postData['registerDate'] = 'test';
        $request = $this->call('POST', '/assignments/api/v1/students/r', $postData);
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The register date is not a valid date.');
    }


// c. 測試
    public function testIndex()
    {
        $request = $this->call('GET', '/assignments/api/v1/students?start=1&limit=10');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(10, $data['data']);
    }

    public function testWithoutParamIndex()
    {
        $request = $this->call('GET', '/assignments/api/v1/students');
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The start field is required.');

        unset($request, $response, $data);

        $request = $this->call('GET', '/assignments/api/v1/students?start=1');
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The limit field is required.');
    }


// d. 測試
    public function testInsertStudent()
    {
        $postData['name']         = 'Drake';
        $postData['registerDate'] = date("Y-m-d");
        $postData['birthday']     = '1990-11-09';
        $request = $this->call('POST', '/assignments/api/v1/students/c', $postData);
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(5, $data['data']);
    }

    public function testWrongFormatStudent()
    {
        $postData['name']         = 'Drake';
        $postData['registerDate'] = date("Y-m-d");
        $request = $this->call('POST', '/assignments/api/v1/students/c', $postData);
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The birthday field is required.');
        unset($postData, $request, $response, $data);

        $postData['registerDate'] = date("Y-m-d");
        $postData['bitrthday']    = date("Y-m-d");
        $request = $this->call('POST', '/assignments/api/v1/students/c', $postData);
        $response = $request->send();
        $this->assertEquals(400, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('error', $data);
        $this->assertEquals($data['error'], 'The name field is required.');
        unset($postData, $request, $response, $data);
    }

// e. 測試
    public function testGrade()
    {
        $request = $this->call('GET', '/assignments/api/v1/students/grades');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode(json_encode($response->getOriginalContent(true)), True);
        $this->assertArrayHasKey('data', $data);
    }

}