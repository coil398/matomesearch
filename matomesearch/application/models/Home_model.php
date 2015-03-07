<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //取得したrssからDBに書き込み
    public function rssInsertDB($xmls)
    {
        foreach($xmls as $xml)
        {
            $blog_title = $xml['channel']['title'];
            $blog_url = $xml['channel']['link'];

            //$this->searchBlogName($blog_title);

            foreach($xml['item'] as $item)
            {
                //書き込み用の配列を作成
        				$insert_array = array(
                        					"url" => $item['link'],
                        					"title" => $item['title'],
                        					"description" => $item['description']
                      					);
                //DBにinsert
        				$this->db->insert('Pages', $insert_array);
            }

        }

    }

    //ブログのタイトルからDB内容を検索
    function searchBlogName($blog_title)
    {
        //ブログタイトルから検索
        $this->db->select('*');
        $this->db->from('Blogs');
        $this->db->where('title='.$blog_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    //DBからページの読み込み
    function loadTags($keyword)
    {
        //
        $this->db->select('*');
        $this->db->from('Tags');
        $this->db->where('name='.$keyword);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function loadAllPages()
    {
        $this->db->select('*');
        $this->db->from('Pages');
        $query = $this->db->get();
        return $query->result_array();

    }



    public function setAllBlogs($items)
    {
        foreach($items as $key => $value)
        {
          //書き込み用の配列を作成
          $insert_array = array(
                            "Title" => $key,
                            "Rss" => $value
                          );
          //DBにinsert
          $this->db->insert('blogs', $insert_array);
        }
    }


}
