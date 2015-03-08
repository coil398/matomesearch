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
      $date = date('Y - m - d');
        foreach($xmls as $xml)
        {
            $blog_title = $xml['channel']['title'];
            $blog_url = $xml['channel']['link'];

            //$this->searchBlogName($blog_title);

            foreach($xml['item'] as $item)
            {
                //書き込み用の配列を作成
        				$insert_array = array(
                        					"Url" => $item['link'],
                        					"Title" => $item['title'],
                        					"Description" => $item['description'],
                                  "Date" => $date
                      					);
                //DBにinsert
        				$this->db->insert('pages', $insert_array);
            }

        }

    }

    //ブログのタイトルからDB内容を検索
    function searchPartOfWordInBlogs($keyword)
    {
        //ブログタイトルから検索
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->like('title', $keyword);
        $this->db->or_like('description', $keyword);
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

    //DBから部分一致で検索
    public function searchPartOfWordInPages($keyword)
    {
        $this->db->select('*');
        $this->db->from('pages');
        $this->db->like('Title', $keyword);
        $this->db->or_like('Description', $keyword);
        //生成されるクエリ ->  // WHERE title LIKE '%$keyword%' OR description LIKE '%$keyword%'
        $query = $this->db->get();
        // echo $query;
        return $query->result_array();
    }



    public function loadAllPages()
    {
        $this->db->select('*');
        $this->db->from('pages');
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
