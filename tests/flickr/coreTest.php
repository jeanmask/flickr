<?php 
/**
 * Tests to Flickr module for kohana
 *
 * @group modules.flickr
 * @author Jean
 */
class Flickr_CoreTest extends Kohana_Unittest_TestCase {
    /**
     * @group modules.flickr.construct
     * @author Jean
     */
    public function test_construct()
    {
        $a = new Flickr();
        $b = Flickr::instance();
        $c = Flickr::instance();

        $this->assertNotSame($a, $b);
        $this->assertSame($b, $c);
    }

    public function provider_query() {
        return array(
          array('flickr.test.echo', array()),
          array('flickr.test.echo', NULL ),
          array('flickr.people.getInfo', array('user_id' => '54989827@N05'))
        );
    }

    /**
     * @group modules.flickr.query
     * @author Jean
     * @depends test_construct
     * @dataProvider provider_query
     */
    public function test_query($method, $param) {
        $data = Flickr::instance()->query($method, $param);
        $this->assertType('array', $data);

        $this->assertArrayHasKey('stat', $data);
        $this->assertEquals('ok', $data['stat'] );
    }

    public function provider_image_url() {
      return array(
        array(
          '4','3194','3031191518','557d4b4980', array(
            's' => 'http://farm4.static.flickr.com/3194/3031191518_557d4b4980_s.jpg',
            't' => 'http://farm4.static.flickr.com/3194/3031191518_557d4b4980_t.jpg',
            'm' => 'http://farm4.static.flickr.com/3194/3031191518_557d4b4980_m.jpg',
            'z' => 'http://farm4.static.flickr.com/3194/3031191518_557d4b4980_z.jpg',
            'b' => 'http://farm4.static.flickr.com/3194/3031191518_557d4b4980_b.jpg',
            'o' => 'http://farm4.static.flickr.com/3194/3031191518_557d4b4980_o.jpg')
        )
      );
    }

    /**
     * @group modules.flickr.image_url
     * @author Jean
     * @depends test_construct
     * @dataProvider provider_image_url
     */
    public function test_image_url($farm_id, $server_id, $id, $secret, $expected) {
      $this->assertSame($expected, Flickr::instance()->image_url($farm_id, $server_id, $id, $secret));
    }
}
