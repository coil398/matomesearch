<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

		public function __construct()
	  {
	    parent::__construct();
	  	$this->load->model('Home_model');
		}

		public function index()
		{
			//各xmlの読み込み
			$xml_lists = $this->loadXml();

			print_r($xml_lists);

			$this->load->view('home_index');
		}


		//xmlの解析して返す
		function loadXml()
		{
			//まとめサイトURLの読み込み
			$url_list = $this->rssUrls();

			//すべてのまとめサイトを配列で管理する
			$xml_lists = array();
			foreach($url_list as $key => $value)
			{
				//xmldataを取得
				$xml = simplexml_load_file($value);
				//jsonにして、配列に整形
				$xml_fix = json_decode(json_encode($xml), true);

				array_push($xml_lists, $xml_fix);
			}


			return $xml_lists;

		}



		//まとめのタイトルとurlを返す
		function rssUrls()
		{

			$urls = array(

			 "いてつくブログ" => "http://fnf.ldblog.jp/index.rdf",

			 "WorldFootballNews" => "http://worldfootballnews.doorblog.jp/index.rdf"/*,

			 "生活ちゃんねる" => "http://seikatuch.com/index.rdf",

			 "アクアカタリスト" => "http://aqua2ch.net/index.rdf",

			 "ぷりそく！" => "http://purisoku.com/index.rdf",

			 "殺風景" => "http://sappukei.livedoor.biz/index.rdf",

			 "素敵な鬼女様" => "http://sutekinakijo.com/index.rdf",

			 "STAGE2;LOG -すてろぐ。-" => "http://stage2log.com/index.rdf",

			 "のーそく｜にゅーす のー そくほう" => "http://nns2ch.net/index.rdf",

			 "鬼女まとめ速報" => "http://kijyosoku.com/index.rdf",

			 "にゅーす特報。" => "http://news109.com/index.rdf",

			 "わらぽん速報" => "http://blog.livedoor.jp/muchio68/index.rdf",

			 "腹筋崩壊ニュース" => "http://www.fknews-2ch.net/index.rdf",

			 "まとめ太郎！" => "http://matome-tarou.ldblog.jp/index.rdf",

			 "ゆめ痛 -NEWS ALERT-" => "http://blog.livedoor.jp/yu_ps13/index.rdf",

			 "育ママ速報" => "http://ikumamasokuhou.doorblog.jp/index.rdf",

			 "芸能ニュースNOW!!" => "http://blog.geinou-now.com/index.rdf",

			 "2ちゃんねるのサッカーまとめブログ" => "http://footballnet.2chblog.jp/index.rdf",

			 "キジトラ速報" => "http://kizitora.doorblog.jp/index.rdf",

			 "Hyper News 2ch" => "http://hypernews.2chblog.jp/index.rdf",

			 "〓 ねこメモ 〓" => "http://nekomemo.com/index.rdf",

			 "あとろぐ速報" => "http://atolog69.com/index.rdf",

			 "フットボール速報" => "http://football-2ch.com/index.rdf",

			 "ピカピカニュース2ch" => "http://pika2.livedoor.biz/index.rdf",

			 "あのにゅーす" => "http://anonews.livedoor.biz/index.rdf",

			 "キムチ速報" => "http://kimsoku.com/index.rdf",

			 "稲妻速報" => "http://inazumanews2.com/index.rdf",

			 "既婚者の墓場" => "http://kikonboti.com/index.rdf",

			 "にゅうにゅうす -アニ萌え情報まとめブログ-" => "http://newnews2ch.com/index.rdf",

			 "GATUN" => "http://blog.livedoor.jp/gatun02/index.rdf",

			 "スコールちゃんねる" => "http://squallchannel.doorblog.jp/index.rdf",

			 "えっ!?またここのサイト?" => "http://www.matacoco.com/index.rdf",

			 "秒刊SUNDAY | 最新の面白ニュースサイト秒刊" => "http://www.yukawanet.com/index.rdf",

			 "ドメサカ板まとめブログ" => "http://blog.livedoor.jp/domesoccer/index.rdf",

			 "２ろぐちゃんねる" => "http://2logch.livedoor.biz/index.rdf",

			 "芸能ニュース｜速報R-30" => "http://r30sokuhou.blog.fc2.com/?xml",

			 "Ayu-Nya EXTRA The World of Today" => "http://ayutube.blog.fc2.com/?xml",

			 "裏芸能スポーツ！にゅ～すしぇあ" => "http://blog.news-share.jp/?xml",

			 "ちゃま速(￣^￣)" => "http://2chmatomefc.blog.fc2.com/?xml",

			 "【2chまとめ】ニュース速報嫌儲版" => "http://newskenm.blog.fc2.com/?xml",

			 "隣人注意報" => "http://blog.livedoor.jp/rinjinyabai/index.rdf",

			 "はぅわ！【2ch】" => "http://blog.livedoor.jp/nico3q3q/index.rdf",

			 "ニュース30over" => "http://www.news30over.com/index.rdf",

			 "鬼嫁ちゃんねる" => "http://oniyomech.livedoor.biz/index.rdf",

			 "ザイーガ" => "http://www.zaeega.com/index.rdf",

			 "結婚・恋愛ニュースぷらす" => "http://blog.livedoor.jp/kekkongo/index.rdf",

			 "VIPリサイクル" => "http://vip.2chblog.jp/index.rdf",

			 "ぴろり速報２ちゃんねる" => "http://pirori2ch.com/index.rdf",

			 "ふぇー速" => "http://fesoku.net/index.rdf",

			 "アニゲー速報ＶＩＰ" => "http://anige-sokuhou.ldblog.jp/index.rdf",

			 "気ままに備忘録 and TIPS" => "http://blog.livedoor.jp/aokichanyon444/index.rdf",

			 "２ちゃん的韓国ニュース" => "http://blog.livedoor.jp/newskorea/index.rdf",

			 "⊂⌒⊃｡Д｡)⊃カジ速≡≡≡⊂⌒つﾟДﾟ)つFull Auto" => "http://www.kajisoku.org/index.rdf",

			 "ろぼ速VIP" => "http://blog.livedoor.jp/robosoku/index.rdf",

			 "Gラボ" => "http://geinolabo.ldblog.jp/index.rdf",

			 "ジャンプ速報" => "http://jumpsokuhou.com/index.rdf",

			 "エレファント速報：SSまとめブログ" => "http://elephant.2chblog.jp/index.rdf",

			 "ソニック速報" => "http://sonicch.com/index.rdf",

			 "こころのそくほう" => "http://cocoronosokuho.doorblog.jp/index.rdf",

			 "らばQ" => "http://labaq.com/index.rdf",

			 "今日速2ch" => "http://kyousoku.net/index.rdf",

			 "ネギ速" => "http://www.negisoku.com/index.rdf",

			 "かつもくブログ" => "http://katsumoku.net/index.rdf",

			 "日刊やきう速報＠なんJ" => "http://blog.livedoor.jp/yakiusoku/index.rdf",

			 "芸能人の気になる噂" => "http://blog.livedoor.jp/uwasainfo/index.rdf",

			 "AKB48まとめんばー" => "http://akb48matome.com/index.rdf",

			 "ラビット速報" => "http://rabitsokuhou.2chblog.jp/index.rdf",

			 "【2ch まとめ】美容と健康ニュース" => "http://www.osmooze.com/index.rdf",

			 "ねとらぼ" => "http://rss.rssad.jp/rss/itm/1.0/netlab.xml",

			 "味噌っぽく2chまとめてみた" => "http://omiso.ldblog.jp/index.rdf",

			 "2chまとめ　あうあうあー" => "http://ababababa7.blog.fc2.com/?xml",

			 "biz2+速報" => "http://blog.livedoor.jp/biz_2/index.rdf",

			 "ニュー速どうでしょう" => "http://blog.livedoor.jp/dudeshow/index.rdf",

			 "春色の空" => "http://karell.blog74.fc2.com/?xml",

			 "日刊ヴァイパー" => "http://roolmine30.blog.fc2.com/?xml",

			 "全力＠速報" => "http://blog.livedoor.jp/zenryoku_sokuhou/index.rdf",

			 "2ch サッカー速報" => "http://soccersokuhou.blog.fc2.com/?xml",

			 "明日もアニオタっ！" => "http://animegamenews.blog.fc2.com/?xml",

			 "コピ速にゅ～す" => "http://kopisoku.doorblog.jp/index.rdf",

			 "野球いいぞ！" => "http://baseballnice.blog.fc2.com/?xml",

			 "BINGO 2ちゃんねる" => "http://kamikiri3x8.blog.fc2.com/?xml",

			 "ムフ速" => "http://blog.livedoor.jp/mufufusokuhou/index.rdf",

			 "速報さん太郎" => "http://2chland.blog.fc2.com/?xml",

			 "SS上手にまとめれたー　-SSまとめブログ-" => "http://ssjyouzu.blog.fc2.com/?xml",

			 "Q速報" => "http://blog.livedoor.jp/qsoku/index.rdf",

			 "まとめる日記" => "http://hideload.blog.fc2.com/?xml",

			 "ニューポット速報～お酒のまとめブログ～" => "http://blog.livedoor.jp/newpot/index.rdf",

			 "政治ちゃんねる" => "http://seiji2ch.ldblog.jp/index.rdf",

			 "ぬいぐるみ　キャラクターグッズ大好き！" => "http://nuigurumi18.blog29.fc2.com/?xml",

			 "焼き増しちゃんねる" => "http://yakimashi.doorblog.jp/index.rdf",

			 "でぃばーす☆速報" => "http://kininarumonoburogu.blog.fc2.com/?xml",

			 "SS属性" => "http://haramimoe.blog.fc2.com/?xml",

			 "えあはい系女子" => "http://eajo.blog.fc2.com/?xml",

			 "泣きっ面にVIP" => "http://blog.livedoor.jp/kinako3011/index.rdf",

			 "ぷに速 ver. あんこ" => "http://punisoku.blog54.fc2.com/?xml",

			 "goggleじゃないよ、gogggleだよ" => "http://gogggle.blog.fc2.com/?xml",

			 "ワニ速" => "http://wanisoku.blog.fc2.com/?xml",

			 "かるそく・軽い気持ち速報" => "http://blog.livedoor.jp/karusoku/index.rdf",

			 "強欲で謙虚な速報" => "http://gosoku.blog.fc2.com/?xml",

			 "にゃんじゃこりゃ！？" => "http://nyankorya.blog.fc2.com/?xml",

			 "コンビニファイト" => "http://conveniencefight.blog.fc2.com/?xml",

			 "すけちゃんＶＩＰ速報" => "http://sukechanv.blog.fc2.com/?xml",

			 "BOOK速報" => "http://booksokuho.blog.fc2.com/?xml",

			 "ゴシゴシなニュース" => "http://blog.livedoor.jp/gpns3/index.rdf",

			 "SSジャンキーちゃんねる" => "http://ssjunkie.blog136.fc2.com/?xml",

			 "うわああああああ速報" => "http://kususoku.blog94.fc2.com/?xml",

			 "コピペ馬鹿 ?創造力の欠如?" => "http://copypa.blog99.fc2.com/?xml",

			 "ムズ痒いブログ" => "http://blog.livedoor.jp/deal_with0603/index.rdf",

			 "特設ニュースちゃんねる" => "http://www.tokusetsu-news.com/rss.php",

			 "キブ速" => "http://kibu-soku.ldblog.jp/index.rdf",

			 "教育情報まとめブログ" => "http://kyoiku-matome.ldblog.jp/index.rdf",

			 "バーニング速報" => "http://burningheart.ldblog.jp/index.rdf",

			 "ぐりもば！｜グリーモバゲーちゃんねる" => "http://blog.livedoor.jp/greemobagech/index.rdf",

			 "ボトラー速報VIP" => "http://blog.livedoor.jp/botosokuvip/index.rdf",

			 "女子速(*´・ω・`*)乙！" => "http://otomatome.blog.fc2.com/?xml",

			 "黒光り通信" => "http://blog.livedoor.jp/kurobikari_tsushin/index.rdf",

			 "【2chまとめ】クッキング速報" => "http://blog.livedoor.jp/blogkoakuma/index.rdf",

			 "株式速報" => "http://kabusoku.com/feed",

			 "きんきゅうおれ速報" => "http://kinkyuoresokuhou.blog.fc2.com/?xml",

			 "ｵﾜﾀの2chまとめだよー＼(^o^)／" => "http://2chmatometayo.blog.fc2.com/?xml",

			 "ヴォドニク速報" => "http://blog.livedoor.jp/vodosoku/index.rdf",

			 "ゲー音好きヅキ！！" => "http://musicians.ldblog.jp/index.rdf",

			 "やる夫我執　愛と誠編" => "http://mukankei769.blog114.fc2.com/?xml",

			 "隣のAA" => "http://tonarinoaa.blog136.fc2.com/?xml",

			 "ヌーそく" => "http://gnusoku.blog41.fc2.com/?xml",

			 "池沼速報" => "http://chisyousokuhou.blog.fc2.com/?xml",

			 "怖い話まとめブログ" => "http://khmb.blog92.fc2.com/?xml",

			 "やる夫短編集　(,,`д`)＜とっても！地獄編" => "http://mukankei961.blog105.fc2.com/?xml",

			 "AAなにっき....〆ﾐ・д・,,ﾐ" => "http://aa2ki.blog108.fc2.com/?xml",

			 "このごろ2ちゃんねる" => "http://blog.livedoor.jp/konogoro2ch/index.rdf",

			 "SS速報VIPPER" => "http://sssokuvip.ldblog.jp/index.rdf",

			 "2ch旅紀行" => "http://tabi2ch.blog.fc2.com/?xml",

			 "デンキクラゲ" => "http://bibibi.info/w/feed/",

			 "やる夫短編集　(,,^ーﾟ)＜すさまじい程に！阿修羅編" => "http://mukankei151.blog47.fc2.com/?xml",

			 "オタク.com" => "http://0taku.livedoor.biz/index.rdf",

			 "落書きニュース" => "http://rakugakinews.prototype-xxx.com/index.xml",

			 "やる夫.jp" => "http://blog.livedoor.jp/nyusokudeyaruo/index.rdf",

			 "続・妄想的日常" => "http://feed.rssad.jp/rss/fc2/mousouteki.blog53",

			 "どうなる速報" => "http://dounaru.doorblog.jp/index.rdf",

			 "【SS宝庫】みんなの暇つぶし" => "http://minnanohimatubushi.2chblog.jp/index.rdf",

			 "やらない夫オンリーブログ" => "http://yaranaioblog.blog14.fc2.com/?xml",

			 "ストレッチ速報" => "http://blog.livedoor.jp/inferunity/index.rdf",

			 "もえぽんず。" => "http://moeponzu.blog.fc2.com/?xml",

			 "ゲームスクウェア" => "http://gamesquare.seesaa.net/index20.rdf",

			 "Bam-Boo（2ch まとめサイト）" => "http://2ch-edit.com/rs3F8/feed/",

			 "|дﾟ)オカルト中毒" => "http://chudoku200.blog66.fc2.com/?xml",

			 "泳ぐやる夫シアター" => "http://feed.rssad.jp/rss/fc2/oyoguyaruo.blog72",

			 "あ2メ速報" => "http://blog.livedoor.jp/ayaponpom-nityannicinici/index.rdf",

			 "2ちゅんまとめ" => "http://matomemamasit.seesaa.net/index20.rdf",

			 "クラウン速報" => "http://tfxamcml.blog.fc2.com/?xml",

			 "マニ速(´Д` )" => "http://zatusugiru-news.livedoor.biz/index.rdf",

			 "watch@2チャンネル" => "http://watch2ch.2chblog.jp/index.rdf",

			 "鏡弥のおすすめ　-　まとめたったった2ｃｈ" => "http://kyoya4616.seesaa.net/index20.rdf",

			 "料理板まとめるよ！" => "http://blog.livedoor.jp/recettedecuisine/index.rdf",

			 "カルチョまとめブログ" => "http://calciomatome.seesaa.net/index20.rdf",

			 "かくれオタのブログ" => "http://zeark969.blog38.fc2.com/?xml",

			 "何でもありんす" => "http://milfled.seesaa.net/index20.rdf",

			 "朧月速報" => "http://blog.livedoor.jp/oboromoons/index.rdf",

			 "流速VIP" => "http://ryusoku.com/index.rdf",

			 "RIDE THE WAVE" => "http://chitekizaisan.blog28.fc2.com/?xml",

			 "ばるろぐ！" => "http://feed.rssad.jp/rss/fc2/barukanlog.blog31",

			 "ガハろぐNewsヽ(･ω･)/ｽﾞｺｰ" => "http://gahalog.2chblog.jp/index.rdf",

			 "噂の芸能２ch" => "http://blog.livedoor.jp/geinou2chnews/index.rdf",

			 "暇人たちの本棚" => "http://hokankoss.blog.fc2.com/?xml",

			 "てさぐり雑報" => "http://tesaguriguri.blog.fc2.com/?xml",

			 "スーパーヒーロー速報2ch" => "http://superherosoku.blog59.fc2.com/?xml",

			 "はぅあぅにゅ～す -声優まとめブログ-" => "http://asuui-seiyunews.doorblog.jp/index.rdf",

			 "なないろコンテンツ" => "http://blog.livedoor.jp/nanaconn/index.rdf",

			 "VIP侵略計画" => "http://vipshinryaku.com/index.rdf",

			 "サッカーまとめblog" => "http://blog.livedoor.jp/mtmsoccer/index.rdf",

			 "ジュピ速" => "http://lamsect.blog112.fc2.com/?xml",

			 "てんこもり。" => "http://tenkomo.blog46.fc2.com/?xml",

			 "なんじゃらほい！" => "http://blog.livedoor.jp/osmay/index.rdf",

			 "【2chまとめ】もう戻れないだろ・・・常識的に考えて<" => "http://2chan.ldblog.jp/index.rdf",

			 "いまさらゲーム速報" => "http://imasaragame.blog74.fc2.com/?xml",

			 "ＳＳいぱいまとめブログ！" => "http://ssipaimatome.blog.fc2.com/?xml",

			 "速報☆東亜政経 (｀・ω・´)" => "http://touaseikei.matomesakura.com/index.rdf",

			 "そくどく！" => "http://blog.livedoor.jp/sokudokuex/index.rdf",

			 "ぬくぬく速報" => "http://blog.livedoor.jp/nukusoku/index.rdf",

			 "カニが威張ってカーニバル" => "http://wasgghdu.blog.fc2.com/?xml",

			 "ナンコレ.TV" => "http://koremoaremokininaru.seesaa.net/index.rdf",

			 "スマホNavi" => "http://mobilephonenavi.blog.fc2.com/?xml",

			 "麻呂の部屋" => "http://blog.livedoor.jp/marole_el-maro/index.rdf",

			 "地球速報" => "http://blog.livedoor.jp/earth_news/index.rdf",

			 "2ch(主にAAとかVIPとかの)まとめ(・∀・)ﾓｴｯ" => "http://fuyune111.blog64.fc2.com/?xml",

			 "痛い投資速報＼(^o^)／" => "http://itato.blog59.fc2.com/?xml",

			 "SS保存場所（けいおん！）" => "http://sshozonbasho.blog90.fc2.com/?xml",

			 "コピペのまとめ" => "http://punipunikopipe.blog.fc2.com/?xml",

			 "資格ちゃんねる" => "http://shikaku2ch.doorblog.jp/index.rdf",

			 "オールジャンルのオージャン" => "http://blog.livedoor.jp/ogenre/index.rdf",

			 "いきものまとめ帳" => "http://ikimonomatometyou.com/index.rdf",

			 "iPhoneで遊ぶ夫" => "http://www.asobuoiphone.com/index.rdf",

			 "２ちゃんねる映画ブログ" => "http://eiga2chan.blog79.fc2.com/?xml",

			 "日本最強伝説" => "http://www.nihon-saikyou.net/feed",

			 "Ｚチャンネル＠ＶＩＰ" => "http://zch-vip.com/index.rdf",

			 "適当にネット小説をまとめる速報" => "http://tekitohsokuhou.blog.fc2.com/?xml",

			 "バイクと！" => "http://baikuto.doorblog.jp/index.rdf",

			 "あんどろいど速報" => "http://androidken.blog119.fc2.com/?xml",

			 "わちゃちゃｗｗ" => "http://wachachaww.2chblog.jp/index.rdf",

			 "あおぞら教室" => "http://bikeyarou2ch.blog.fc2.com/?xml",

			 "2ちゃんねるまとめ 名前はまだない" => "http://heekogirl.blog.fc2.com/?xml",

			 "本日のメタルスレ" => "http://blog.livedoor.jp/honmeta/index.rdf",

			 "インテリライフ2ch" => "http://intellife2ch.com/index.rdf",

			 "おもいっきり濁点" => "http://kiri550.blog94.fc2.com/?xml",

			 "ダイエットまとめ" => "http://blog.livedoor.jp/prestoo/index.rdf",

			 "蟲ちゃんねる！" => "http://mushich.blog.fc2.com/?xml",

			 "つきのはーもにー" => "http://blog.livedoor.jp/tukinoharmony/index.rdf",

			 "やる夫と学ぶ就職活動" => "http://www.yaru-mana.com/index.rdf",

			 "【2ch】歴史的大敗" => "http://blog.livedoor.jp/sangokuken/index.rdf",

			 "笑ってほのぼのとして軽く泣けるはなし　（と不思議話と怖い話）" => "http://blog.livedoor.jp/omohana/index.rdf",

			 "暇は無味無臭の劇薬" => "http://blog.livedoor.jp/drazuli/index.rdf",

			 "Trans Vienna -ドイツ語翻訳-" => "http://blog.livedoor.jp/trans_vienna/index.rdf",

			 "翻訳『タイムフライズ』" => "http://kaigai-anime.com/?feed=rss2",

			 "カイカイ反応通信" => "http://blog.livedoor.jp/kaikaihanno/index.rdf",

			 "P magazine" => "http://rifuu.blog129.fc2.com/?xml",

			 "ぱんだ とらんすれーたー" => "http://blog.livedoor.jp/panda_translator/index.rdf",

			 "海外反応まとめブログ館" => "http://kaigai3533.blog.fc2.com/?xml",

			 "新翻訳こんにゃくお味噌味" => "http://blog.livedoor.jp/honnyaku_blog/index.rdf",

			 "翻訳こんにゃくお味噌味" => "http://animeng.blog5.fc2.com/?xml",

			 "海外反応！　I LOVE JAPAN" => "http://blog.livedoor.jp/zzcj/index.rdf",

			 "しお韓、半万年の歴史" => "http://siokan5000.blog.fc2.com/?xml",

			 "劇訳表示。" => "http://www.gekiyaku.com/index.rdf",

			 "パンドラの憂鬱" => "http://kaigainohannoublog.blog55.fc2.com/?xml",

			 "ダイエット速報＠2ちゃんねる" => "http://blog.livedoor.jp/diet2channel/index.rdf",

			 "結婚速報" => "http://www.kekkon-sokuho.com/index.rdf",

			 "おいしく（´・ω・｀）いただきます" => "http://8989itadakimasu.blog89.fc2.com/?xml",

			 "鬼女の人生ブログ(`・ω・´)" => "http://keiba1140blog.blog.fc2.com/?xml",

			 "おうち速報" => "http://ouchinews.doorblog.jp/index.rdf",

			 "喪女のまとめブログ" => "http://blog.livedoor.jp/takeit8/index.rdf",

			 "勘違い男による被害報告 まとめ" => "http://kansuke.doorblog.jp/index.rdf",

			 "キスログ" => "http://kisslog2.com/index.rdf",

			 "母J( 'ｰ`)しちゃんねる" => "http://blog.livedoor.jp/kaaaaach/index.rdf",

			 "はーとログ" => "http://blog.livedoor.jp/love120331/index.rdf",

			 "キチガイママまとめ保管庫" => "http://www.kitimama-matome.net/index.rdf",

			 "[2ch]お料理速報" => "http://oryouri.2chblog.jp/index.rdf",

			 "行き掛けの駄賃" => "http://kopipe2011.blog116.fc2.com/?xml",

			 "本当にやった復讐　まとめ" => "http://revenge.doorblog.jp/index.rdf",

			 "すくすくちゃんねる" => "http://benrikosodate.blog.fc2.com/?xml",

			 "農家の暗部 まとめ" => "http://noukanoanbu.doorblog.jp/index.rdf",

			 "人生相談まとめ＠２ｃｈ" => "http://jinseisoudan2ch.blog.fc2.com/?xml",

			 "鬼女速" => "http://kijyosokuhou.blog.fc2.com/?xml",

			 "飲食速報(ﾟдﾟ)ｳﾏ- 2chまとめブログ" => "http://insyoku.livedoor.biz/index.rdf",

			 "はなろぐ" => "http://hanalog.com/index.rdf",

			 "ロミオメールまとめ" => "http://romeomail.doorblog.jp/index.rdf",

			 "修羅場速報" => "http://syurasoku.blog.fc2.com/?xml",

			 "どすこい喪女どんとこい鬼女" => "http://mojyo-dokujyo-kijyo.2chblog.jp/index.rdf",

			 "鬼女と喪女" => "http://feed.rssad.jp/rss/fc2/kijomojo.blog",

			 "くいもんニュース" => "http://blog.livedoor.jp/kuimonnew/index.rdf",

			 "子育て速報" => "http://kosonews.blog135.fc2.com/?xml",

			 "akb(ﾒ・ん・)？" => "http://akbakb0048.doorblog.jp/index.rdf",

			 "ももクロまとめんだーZ" => "http://mcz.ldblog.jp/index.rdf",

			 "もきゅ速(*´ω`*)人(´･ェ･｀)" => "http://blog.livedoor.jp/aoba_f/index.rdf",

			 "萌えろ!!芸スポなんJ -芸能人はネタが命-" => "http://moentame.blog.fc2.com/?xml",

			 "あたしのスポーツにゅうす@なんJ" => "http://atasino.com/index.rdf",

			 "Samurai GOAL ～海外で活躍する日本人選手まとめ" => "http://samuraigoal.doorblog.jp/index.rdf",

			 "なんＪボンバー" => "http://blog.livedoor.jp/nanj_bom/index.rdf",

			 "しゃーないＪ" => "http://syanaij.blog.fc2.com/?xml",

			 "なんJやで～" => "http://blog.livedoor.jp/nanj2ch/index.rdf",

			 "カワイイちゃんねる" => "http://blog.livedoor.jp/cawaii_ch/index.rdf",

			 "猛兎魂" => "http://blog.livedoor.jp/moutodamashii/index.rdf",

			 "なんじぇいスタジアム" => "http://blog.livedoor.jp/nanjstu/index.rdf",

			 "サッカーコピペまとめブログ" => "http://soccercopype.ldblog.jp/index.rdf",

			 "AKB48タイムズ" => "http://akb48taimuzu.livedoor.biz/index.rdf",

			 "SKE48まとめエンクラ" => "http://encra48.doorblog.jp/index.rdf",

			 "アイドルモリ" => "http://idolmori.blog31.fc2.com/?xml",

			 "WASHI?NOTE -ワシノート-" => "http://washinote.blog137.fc2.com/?xml",

			 "AKBip!" => "http://blog.livedoor.jp/akbip/index.rdf",

			 "もっとべーすぼーる！" => "http://blog.livedoor.jp/nanjbaseball/index.rdf",

			 "156番速報＠なんJ" => "http://blog.livedoor.jp/sora156/index.rdf",

			 "[AKB48]AKLOG!!" => "http://akb48aklog.ldblog.jp/index.rdf",

			 "兄弟分ナロウゼ＠なんJ" => "http://chi-wo.com/index.rdf",

			 "野球のまとめサイト作るよ!!" => "http://blog.livedoor.jp/danji4223/index.rdf",

			 "AKBコロンビア速報(AKB面白まとめブログ)" => "http://blog.livedoor.jp/matome_2ch_/index.rdf",

			 "SKE48まとめもらんだむ" => "http://ske48matomemo.doorblog.jp/index.rdf",

			 "モノが違います速報-赤鯉魂-" => "http://r30r30.blog51.fc2.com/?xml",

			 "ぱるてのん" => "http://blog.livedoor.jp/parthenon_k/index.rdf",

			 "おはよう！ぷろじぇくと通信局" => "http://oha2.blog.fc2.com/?xml",

			 "2ch的競馬ニュース" => "http://2chkeibanews.blog39.fc2.com/?xml",

			 "キャッチャーライナー" => "http://blog.livedoor.jp/catcherliner/index.rdf",

			 "イレブン速報" => "http://2ch11soccer.blog.fc2.com/?xml",

			 "なんJ（まとめては）いかんのか？" => "http://blog.livedoor.jp/livejupiter2/index.rdf",

			 "サッカーニュース速報" => "http://blog.livedoor.jp/football_news001/index.rdf",

			 "なんJ PRIDE" => "http://blog.livedoor.jp/rock1963roll/index.rdf",

			 "まとめですか、フハハ！" => "http://blog.livedoor.jp/fuhaha_saitho/index.rdf",

			 "まとめるんだJ" => "http://matomerundaj.blog.fc2.com/?xml",

			 "ノムさん速報＠なんJ" => "http://yakyusoku12.blog.fc2.com/?xml",

			 "アイドル情報 狼まとめのめ" => "http://blog.livedoor.jp/sg12dream/index.rdf",

			 "おバサカ速報" => "http://bakasoku.doorblog.jp/index.rdf",

			 "そうだ、野球を見よう" => "http://watchbaseball2ch.blog.fc2.com/?xml",

			 "アイドルニュース（狼）" => "http://blog.livedoor.jp/idolookami/index.rdf",

			 "なお、まにあわんもよう@なんJ" => "http://blog.livedoor.jp/nanjyakyubu/index.rdf",

			 "F1情報通" => "http://f1jouhou2.blog.fc2.com/?xml",

			 "ってなんじぇですかー" => "http://blog.livedoor.jp/bmaysu/index.rdf",

			 "GIOGIOの奇妙な速報‐AKB48まとめたのヽ(ﾟ⊥ﾟ)ﾉ" => "http://www.giogio48.com/index.rdf",

			 "乃木坂46まとめブログ" => "http://blog.livedoor.jp/ngzk46/index.rdf",

			 "競馬ろまん亭　-競馬まとめ-" => "http://blog.livedoor.jp/admiretry/index.rdf",

			 "執拗にAKB" => "http://akbmato.doorblog.jp/index.rdf",

			 "２ちゃんを斬る！" => "http://kiru2ch.com/index.rdf",

			 "ベースボールスレッド" => "http://kyuukaiou.ldblog.jp/index.rdf",

			 "感汁！2chまとめ" => "http://goodboy22ch.blog69.fc2.com/?xml",

			 "サッカー2chまとめ" => "http://2chsoccerballgame.seesaa.net/index.rdf",

			 "AKB48まとめ 48年戦争" => "http://akb48nensensou.net/index.rdf",

			 "AKB48 NEWS TIMES (AKB48まとめブログ)" => "http://akb48newstimes.doorblog.jp/index.rdf",

			 "あーかーべー速報" => "http://blog.livedoor.jp/akb48sokuho/index.rdf",

			 "イレブンちゃんねる" => "http://blog.livedoor.jp/elevenchannel/index.rdf",

			 "カプ速" => "http://kapusoku.blog.fc2.com/?xml",

			 "GIANTSBLOG" => "http://howkspride.blog133.fc2.com/?xml",

			 "野球猫びいき" => "http://blog.livedoor.jp/plhfmbe/index.rdf",

			 "ももいろクローバーZまとめブログ「ももログ」" => "http://blog.livedoor.jp/momomaton/index.rdf",

			 "野球なんだ" => "http://yakyuboz.blog.fc2.com/?xml",

			 "非常識＠なんJ～野球ネタを中心にまとめるブログ～" => "http://absurd.blogo.jp/index.rdf",

			 "戦うヒト速報" => "http://feed.rssad.jp/rss/fc2/tatakauhito.blog",

			 "AKB48速報" => "http://akb48sokuhou.doorblog.jp/index.rdf",

			 "自分はなんJ" => "http://blog.livedoor.jp/jibunan/index.rdf",

			 "ぐう速" => "http://blog.livedoor.jp/guusoku/index.rdf",

			 "芸能ニュース２ch報道" => "http://geinou2news.blog.fc2.com/?xml",

			 "芸スポニャース" => "http://nya-su.doorblog.jp/index.rdf",

			 "隣人はオタク" => "http://nerd.livedoor.biz/index.rdf",

			 "あげあげニュース" => "http://trivianews.doorblog.jp/index.rdf",

			 "浪漫武器速報" => "http://romanbuki-sokuhou.doorblog.jp/index.rdf",

			 "虹神速報～にじそく～" => "http://blog.livedoor.jp/nizigami/index.rdf",

			 "VIP Gamer" => "http://www.vipgamer.jp/index.rdf",

			 "やるじぇい！" => "http://yaruj.doorblog.jp/index.rdf",

			 "私はゲームを続けるよ！" => "http://watagee3.blog.fc2.com/?xml",

			 "るふわ速報" => "http://garethbale.blog.fc2.com/?xml",

			 "ゆるく生きていたい" => "http://yurunews.doorblog.jp/index.rdf",

			 "家宝は2次元" => "http://kahouha2jigen.blog.fc2.com/?xml",

			 "ノムケン！！" => "http://blog.livedoor.jp/nomuken77/index.rdf",

			 "ゆりプラス+" => "http://victorique2.blog.fc2.com/?xml",

			 "２してん！" => "http://news.huku1.com/RSS/",

			 "おたじゅうぶろぐ" => "http://otajyuu.blog40.fc2.com/?xml",

			 "オレノメモチョウ" => "http://orememo.net/?mode=rss",

			 "まと☆マギ ブログ" => "http://matomagi.doorblog.jp/index.rdf",

			 "ジョジョ速" => "http://blog.livedoor.jp/jyojyo_soku/index.rdf",

			 "デレマス -アイドルマスターシンデレラガールズまとめサイト-" => "http://deremas.doorblog.jp/index.rdf",

			 "アイマス☆特番" => "http://imastokuban.blog.fc2.com/?xml",

			 "にゃんこびより(=^･ω･^)" => "http://ankosokuho.blog.fc2.com/?xml",

			 "HighGamers" => "http://highgamers.com/index.rdf",

			 "俺ステ速報" => "http://blog.livedoor.jp/orestesokuhou/index.rdf",

			 "モンハン速報" => "http://monsoku.ldblog.jp/index.rdf",

			 "大人のゲーム2ch雑談所" => "http://saralymangame.blog98.fc2.com/?xml",

			 "キカイジカケ｜ペルソナ系情報まとめブログ" => "http://blog.livedoor.jp/p_boxes/index.rdf",

			 "fig速" => "http://figsoku.blog39.fc2.com/?xml",

			 "とごたん！" => "http://blog.livedoor.jp/togotan/index.rdf",

			 "さむわんわんわん" => "http://someoneone.blog116.fc2.com/?xml",

			 "チェック☆ゲーバナ" => "http://checkgebana.blog69.fc2.com/?xml",

			 "神羅＠ゲーム速報" => "http://blog.livedoor.jp/yuuzi2010/index.rdf",

			 "終わらないコンテンツ速報" => "http://owacon.livedoor.biz/index.rdf",

			 "ONE PIECE CHANNEL" => "http://onepiecechannel.blog.fc2.com/?xml",

			 "ニャル速！" => "http://blog.livedoor.jp/kuko0619-nyarusoku/index.rdf",

			 "ヲタク速報" => "http://otasoku.livedoor.biz/index.rdf",

			 "ニュー天丼速報→WARAWARA" => "http://newtendon.doorblog.jp/index.rdf",

			 "アニまる速報" => "http://animarusokuho.doorblog.jp/index.rdf",

			 "PS速報" => "http://www.pssokuhou.jp/index.rdf",

			 "カンダタ速報" => "http://kandatasokuho.blog.fc2.com/?xml",

			 "人生デフラグ中" => "http://defuragutyuu.blog.fc2.com/?xml",

			 "おたなめっ！" => "http://otaname.com/index.rdf",

			 "アゲ速VIP" => "http://agesoku.2chblog.jp/index.rdf",

			 "HUNTER×HUNTER×" => "http://hunter31.blog.fc2.com/?xml",

			 "ゲハ・ログ" => "http://geha-2ch.ldblog.jp/index.rdf",

			 "声優☆速報" => "http://seiyuusokuhou.blog106.fc2.com/?xml",

			 "おにっこ速報" => "http://onirin.blog.fc2.com/?xml",

			 "マーメイル速報 -遊戯王まとめサイト" => "http://yuugiousokuhou.doorblog.jp/index.rdf",

			 "げーむがーる・こんぷれっくす！" => "http://blog.livedoor.jp/beninaga/index.rdf",

			 "ヒーローチャンネル" => "http://hero-ch.com/?xml",

			 "二次元情報" => "http://blog.livedoor.jp/nizigenzyouhoudesu-sono2/index.rdf",

			 "JUMPER" => "http://jumper2ch.blog.fc2.com/?xml",

			 "もえぶたそくほ～" => "http://blog.livedoor.jp/moebutasokuho/index.rdf",

			 "ゲーマーズブログ" => "http://game129.blog.fc2.com/?xml",

			 "ジャンプまとめ速報" => "http://jumpmatome2ch.blog.fc2.com/?xml",

			 "声優" => "http://seiyuui.com/?xml",

			 "スパロボ速報" => "http://blog.livedoor.jp/suparobosokuhou/index.rdf",

			 "ゲハ速" => "http://gehasoku.com/index.rdf",

			 "seiyu fan - 声優･アニメ" => "http://blog.livedoor.jp/seiyufan/index.rdf",

			 "オタクニュース" => "http://otanew.jp/index.rdf",

			 "懐古速報VIP" => "http://kaikosokuhouvip.blog103.fc2.com/?xml",

			 "JAMぐる" => "http://jamberry.at.webry.info/rss/index.rdf",

			 "うるるんロギー" => "http://rakusyasa.blog41.fc2.com/?xml",

			 "インバリアント -SSまとめサイト-" => "http://feed.rssad.jp/rss/fc2/invariant0.blog130",

			 "明日につながるSS" => "http://asuss2chvip.blog.fc2.com/?xml",

			 "SSウィーバー" => "http://blog.livedoor.jp/ssweaver/index.rdf",

			 "ゆるゆりSS速報" => "http://blog.livedoor.jp/kakusika767/index.rdf",

			 "SSなSPECIAL" => "http://ssspecial578.blog135.fc2.com/?xml",

			 "えすえすMIX-SSまとめサイト-" => "http://ss-mix.livedoor.biz/index.rdf",

			 "やる夫まとめもZ" => "http://matomemo3.blog.fc2.com/?xml",

			 "ストーリア速報：SSまとめブログ" => "http://ssstoria.com/index.rdf",

			 "あやめ速報-SSまとめ-" => "http://blog.livedoor.jp/ayamevip/index.rdf",

			 "かぎまとめ" => "http://hookey.blog106.fc2.com/?xml",

			 "ストライク　SS" => "http://netocean.blog.fc2.com/?xml",

			 "おかしくねーしSSまとめ" => "http://blog.livedoor.jp/dpdmx702/index.rdf",

			 "百合チャンネル" => "http://lilymate.blog.fc2.com/?xml",

			 "わた速　SS　まとめブログ" => "http://feed.rssad.jp/rss/fc2/yomiyama.blog",

			 "新AAまとめブログ(´∀｀)" => "http://blog.livedoor.jp/aamatome/index.rdf",

			 "AAまとめブログ(´∀｀)" => "http://aamatome.blog31.fc2.com/?xml",

			 "SSだもんげ！" => "http://newscrap-ss.doorblog.jp/index.rdf",

			 "SSちゃんねる" => "http://ssflash.net/index.rdf",

			 "かも速／SS・アニメまとめブログ" => "http://2chmoeaitemu.dtiblog.com/?xml",

			 "ひとよにちゃんねる" => "http://142ch.blog90.fc2.com/?xml",

			 "絶望速報" => "http://blog.livedoor.jp/zetusoku/index.rdf",

			 "速報は無理" => "http://dqff14.2chblog.jp/index.rdf",

			 "俺のにゅうす" => "http://newsoreore.blog.fc2.com/?xml",

			 "まとめす2ch" => "http://matomesu2ch.com/index.rdf",

			 "snap速報" => "http://snasoku.ldblog.jp/index.rdf",

			 "あっ・・・ＶＩＰＰＥＲだ///" => "http://vipper2ch.doorblog.jp/index.rdf",

			 "おにぎり速報VIP" => "http://www.onisoku.info/index.rdf",

			 "カリモフ" => "http://kari2mofu2.com/index.rdf",

			 "ろむせん！！ | ROM専のための２ちゃんねるまとめブログ" => "http://blog.livedoor.jp/romsenmatome3/index.rdf",

			 "スレスト１０００本ノック" => "http://threadstoper1000.doorblog.jp/index.rdf",

			 "いたち速報ェ･･･" => "http://msy738.blog75.fc2.com/?xml",

			 "輝く翼" => "http://akatsukishana.blog27.fc2.com/?xml",

			 "キタコレ(ﾟ∀ﾟ)！！" => "http://kita-kore.com/index.rdf",

			 "まとめでぃあ" => "http://totalmatomedia.blog.fc2.com/?xml",

			 "クッソｗｗｗｗ速報" => "http://blog.livedoor.jp/kussoku111/index.rdf",

			 "ララララ速報" => "http://lalalala2chlalalala.blog133.fc2.com/?xml",

			 "クリームソーダ飲みたい速報" => "http://blog.livedoor.jp/sodanomitai/index.rdf",

			 "いかす速報－イカ速VIP" => "http://blog.livedoor.jp/ikasoku_vip/index.rdf",

			 "（∪＾ω＾）わんわんお！" => "http://wan2o.com/feed",

			 "ゆるりと -２ｃｈまとめ-" => "http://blog.livedoor.jp/yururimato/index.rdf",

			 "【２ｃｈ】ニーてつVIPブログ" => "http://neetetsu.com/index.rdf",

			 "ふよふよ速報。" => "http://huyosoku.com/index.rdf",

			 "駄目人間速報" => "http://damesoku.blog114.fc2.com/?xml",

			 "にゃあ速報VIP" => "http://nyaasokuvip.blog.fc2.com/?xml",

			 "ねむ速" => "http://blog.livedoor.jp/nemusoku/index.rdf",

			 "まとめDays" => "http://blog.matomeday.com/index.rdf",

			 "ウラネタ！" => "http://uraneta2ch.blog.fc2.com/?xml",

			 "モモンガ速報" => "http://momosoku.doorblog.jp/index.rdf",

			 "お気に入り速報" => "http://blog.livedoor.jp/okisoku0/index.rdf",

			 "くるくるＶＩＰ" => "http://blog.livedoor.jp/kuru2vip/index.rdf",

			 "あな速報る" => "http://anarusokuhou.doorblog.jp/index.rdf",

			 "VIPツェッペリン" => "http://www.vipzeppelin.com/index.rdf",

			 "ゆるりと　ひじきそくほう" => "http://hijikisokuhou.doorblog.jp/index.rdf",

			 "2chニュース速報VIP" => "http://2ch-news-vip.info/index.rdf",

			 "2次元は戦場｜にじせん" => "http://blog.livedoor.jp/nizibf/index.rdf",

			 "就職活動応援ちゃんねる" => "http://blog.livedoor.jp/syuukatu802/index.rdf",

			 "来世から本気出す" => "http://blog.livedoor.jp/raisekarahonnkidasu/index.rdf",

			 "おっさんスレまとめブログ" => "http://blog.livedoor.jp/ossan2ch/index.rdf",

			 "ぼっち速報" => "http://bottisoku.blog.fc2.com/?xml",

			 "新かれっじライフハッキング" => "http://college2ch.blomaga.jp/index.rdf",

			 "かれっじライフハッキング" => "http://lifehacking.doorblog.jp/index.rdf",

			 "二次元まるごと！" => "http://blog.livedoor.jp/nizimaru/index.rdf",

			 "日々なんちゃら速" => "http://blog.livedoor.jp/hibinanchara/index.rdf",

			 "HEY速" => "http://heysoku.blog.fc2.com/?xml",

			 "ドリームちゃんねる" => "http://blog.livedoor.jp/altemawx-dream/index.rdf",

			 "ひょんじ速報" => "http://hyonji.blog91.fc2.com/?xml",

			 "ν即のまとめ" => "http://newsoku318.blog134.fc2.com/?xml",

			 "もじゃもじゃVIP、略してもっぷ" => "http://runxz.blog4.fc2.com/?xml",

			 "東亜news+" => "http://toanewsplus.blog60.fc2.com/?xml",

			 "笑　韓　ブログ" => "http://www.wara2ch.com/index.rdf",

			 "ねとうよ速報" => "http://netosoku.net/feed/",

			 "保守速報" => "http://www.hoshusokuhou.com/index.rdf",

			 "清貧まとめ" => "http://blog.livedoor.jp/seihinmatome/index.rdf",

			 "痛い相談(ﾉω｀)" => "http://itaisoudan.seesaa.net/index.rdf",

			 "2chエクサワロス" => "http://exawarosu.net/index.rdf",

			 "【2ch】どや速VIP　どやさ速報" => "http://blog.livedoor.jp/doyasoku2ch/index.rdf",

			 "ねたＱぶ" => "http://blog.livedoor.jp/netacube/index.rdf",

			 "腹筋崩壊ニュース" => "http://fknews.ldblog.jp/index.rdf",

			 "嫌キチニュース" => "http://blog.livedoor.jp/iyakiti/index.rdf",

			 "きになるニト速(〃´・ω・`)" => "http://nitosokusinn.blog.fc2.com/?xml",

			 "ブヒるニュース速報" => "http://buhisoku.blog28.fc2.com/?xml",

			 "すた☆速報" => "http://blog.livedoor.jp/sutasok/index.rdf",

			 "ロン速" => "http://blog.livedoor.jp/ronsoku2/index.rdf",

			 "2ちゃん　わらふ" => "http://blog.livedoor.jp/warafukunews/index.rdf",

			 "マネーニュース2ch" => "http://okanehadaiji.doorblog.jp/index.rdf",

			 "にゃんちゅ～にゅ～す" => "http://blog.livedoor.jp/nekokan2011/index.rdf",

			 "WorldNews2ch" => "http://worldnews2ch.com/index.rdf",

			 "おーるじゃんる" => "http://blog.livedoor.jp/crx7601/index.rdf",

			 "お仕事速報ヽ(ﾟ∀ﾟ)ﾉ2ちゃんねる" => "http://osigotosokuho.blog.fc2.com/?xml",

			 "Web雑" => "http://webzatsu.com/?feed=rss2",

			 "ねたにゅーす" => "http://netanewsvip.blog31.fc2.com/?xml",

			 "iPhone痛" => "http://www.iphoneita.com/index.rdf",

			 "神速報～かみそく～" => "http://blog.livedoor.jp/kamisokuhou/index.rdf",

			 "痛ちゃんねる" => "http://dqnchannel.blog.fc2.com/?xml",

			 "気になるたけのこ速報VIP" => "http://takenokosokuhou.com/index.rdf",

			 "教えて！はかどる速報" => "http://hakadoru-sokuho.com/feed/rdf",

			 "大艦巨砲主義！" => "http://military38.com/index.rdf",

			 "話題の道標" => "http://wadainomitisirube.com/index.rdf",

			 "U-1速報" => "http://u1sokuhou.ldblog.jp/index.rdf",

			 "おまえら速報" => "http://omasoku.blog90.fc2.com/?xml",

			 "（＾ν＾）速報 - にゅっそく" => "http://blog.livedoor.jp/nyussoku/index.rdf",

			 "mashlife通信" => "http://mashlife.doorblog.jp/index.rdf",

			 "ニンジャ速報" => "http://ninjyaoh.blog.fc2.com/?xml",

			 "かたつむり速報" => "http://kina.doorblog.jp/index.rdf",

			 "FX速報" => "http://traderlive.doorblog.jp/index.rdf",

			 "エンタメ速報" => "http://entamesokuhou.livedoor.biz/index.rdf",

			 "あら速" => "http://arasoku.ldblog.jp/index.rdf",

			 "CYBER LIFE 2CH" => "http://www.cyber-life.info/index.rdf",

			 "ネタさか2ch" => "http://blog.livedoor.jp/netasaka/index.rdf",

			 "ふりーちゃんねる" => "http://free2ch.2chblog.jp/index.rdf",

			 "情弱ニュース２ｃｈ" => "http://jyojyakunews.doorblog.jp/index.rdf",

			 "きゃっつあいにゅーす" => "http://rastaneko.blog.fc2.com/?xml",

			 "まるちゃんねる" => "http://blog.livedoor.jp/maru2channel/index.rdf",

			 "るな速" => "http://blog.livedoor.jp/lunasoku/index.rdf",

			 "(´・ω・｀)ｼｮﾎﾞｰﾝ速報" => "http://feed.rssad.jp/rss/fc2/higedharma.blog90",

			 "2chまとめぴーぺ" => "http://pype.blog28.fc2.com/?xml",

			 "ジャックログ　　2chJacklog" => "http://jacklog.doorblog.jp/index.rdf",

			 "ズコログニュース(･ω･)" => "http://zukolog.livedoor.biz/index.rdf",

			 "世界的BBSニュース" => "http://sekaiteki.net/index.rdf",

			 "VIPでニュース！" => "http://vyoro.com/index.rdf",

			 "カルチョまとめブログ" => "http://calciomatome.seesaa.net/index.rdf",

			 "【2ch】気になったニュース(`・ω・´)" => "http://kininatta2chmatome.doorblog.jp/index.rdf",

			 "にわか日報" => "http://niwaka2pow.blog.fc2.com/?xml",

			 "ヒマトーーク" => "http://himatubushi109.blog.fc2.com/?xml",

			 "特定しますたm9" => "http://www.tokuteishimasuta.com/index.rdf",

			 "あじあにゅーす２ちゃんねる-2chｱｼﾞｱﾆｭｰｽ-" => "http://asianews2ch.livedoor.biz/index.rdf",

			 "とかちでVIP" => "http://tokati.livedoor.biz/index.rdf",

			 "【乞食速報】" => "http://kojikisokuhou.doorblog.jp/index.rdf",

			 "本音ちゃんねる" => "http://www.honne-ch.com/index.rdf",

			 "日刊ニログ" => "http://vipvipnews.com/index.rdf",

			 "ガジェット速報" => "http://ggsoku.com/feed/",

			 "cloudnote pickup" => "http://2ch.cloudnote.jp/rss/pickup",

			 "いたしん！" => "http://itaishinja.com/index.rdf",

			 "ラジック" => "http://rajic.2chblog.jp/index.rdf",

			 "ヴィブロ" => "http://gasoku.livedoor.biz/index.rdf",

			 "hogehoge速報" => "http://hogehogesokuhou.ldblog.jp/index.rdf",

			 "今から本気出す(｀･д･´)" => "http://imakara-honkidasu.doorblog.jp/index.rdf",

			 "FF３５しようずｗｗｗｗｗｗ" => "http://finalfantasy35.blog45.fc2.com/?xml",

			 "ツンダオワタ情報" => "http://feeds.feedburner.com/tundaowatainfo",

			 "長文乙！" => "http://blog.livedoor.jp/yohoo123matome/index.rdf",

			 "芸能 ニュース特ダネ" => "http://geinounewstokudane.blog76.fc2.com/?xml",

			 "なんJ PRIDE" => "http://blog.livedoor.jp/rock1963roll/index.rdf",

			 "ニンニン速報" => "http://ninninnsoku.doorblog.jp/index.rdf",

			 "乙ちゃんねる！2chまとめブログ" => "http://blog.livedoor.jp/o2ch/index.rdf",

			 "ガラパゴス速報 跡地" => "http://galasoku.livedoor.biz/index.rdf",

			 "戦争の夜へようこそ" => "http://feeds.fc2.com/fc2/xml?host=teiiku73narabayoshi.blog3",

			 "まんはったん！ -万次郎のサブカル系ブログ-" => "http://subcultureblog.blog114.fc2.com/?xml",

			 "ヒロイモノ中毒" => "http://cherio199.blog120.fc2.com/?xml",

			 "SS 森きのこ！：SSまとめブログ" => "http://morikinoko.com/index.rdf",

			 "調理兵はVIPPERだった" => "http://blog.livedoor.jp/nonvip/index.rdf",

			 "サルでもわかる速報" => "http://blog.livedoor.jp/sarusoku/index.rdf",

			 "ゴタゴタシタニュース" => "http://blog.livedoor.jp/gotagotashita/index.rdf",

			 "アンダーワールド" => "http://underworld2ch.blog29.fc2.com/?xml",

			 "ネトウヨにゅーす。" => "http://netouyonews.net/index.rdf",

			 "オシロ速報" => "http://amplitude.blog83.fc2.com/?xml",

			 "ちょっと２ちゃんねる" => "http://gogo2chmeguri.blog91.fc2.com/?xml",

			 "Sound Field ～オーディオのまとめ～" => "http://moeaudio.blog29.fc2.com/?xml",

			 "東京イケメン速報" => "http://iekemencom.blog9.fc2.com/?xml",

			 "鶏肉を取りに行く" => "http://torinikui.blog112.fc2.com/?xml",

			 "安心ちゃんねる！" => "http://x2chx.blog82.fc2.com/?xml",

			 "政経ch" => "http://fxya.blog129.fc2.com/?xml",

			 "音楽ちゃんねる" => "http://music2chan.blog88.fc2.com/?xml",

			 "芸能ひまつぶし" => "http://geinouhima.blog18.fc2.com/?xml",

			 "秒速ニューろぐ.url" => "http://newslog2ch.blog8.fc2.com/?xml",

			 "東京エスノ" => "http://blog.livedoor.jp/video_news/index.rdf",

			 "スチーム速報　ＶＩＰ" => "http://newsteam.livedoor.biz/index.rdf",

			 "ちゃんねるZ" => "http://channelz.blog118.fc2.com/?xml",

			 "にゅーるぽ（・∀・）" => "http://feed.rssad.jp/rss/fc2/horo346.blog75",

			 "【2ch】ニュー速VIPブログ(`･ω･´)" => "http://blog.livedoor.jp/insidears/index.rdf",

			 "オレ的ゲーム速報＠刃" => "http://jin115.com/index.rdf",

			 "うらやましからん" => "http://urayamashikaran.blog44.fc2.com/?xml",

			 "新(*ﾟ∀ﾟ)ゞカガクニュース隊" => "http://www.scienceplus2ch.com/index.rdf",

			 "(*ﾟ∀ﾟ)ゞカガクニュース隊" => "http://scienceplus2ch.blog108.fc2.com/?xml",

			 "ヌコニュース" => "http://nukohiroba.blog32.fc2.com/?xml",

			 "ああ、昔にもどりたい" => "http://blogrss.shinobi.jp/rss/ninja/aruite5",

			 "豚速" => "http://ton4soku.blog84.fc2.com/?xml",

			 "F速VIP" => "http://fsokuvip.blog101.fc2.com/?xml",

			 "ベア速" => "http://vipvipblogblog.blog119.fc2.com/?xml",

			 "NakamaNews" => "http://aln1025.blog39.fc2.com/?xml",

			 "ニュース超速報！" => "http://turenet.blog91.fc2.com/?xml",

			 "イフカルト" => "http://blog.livedoor.jp/wordroom/index.rdf",

			 "メシウマ速報m9(^Д^)" => "http://2ch774.blog55.fc2.com/?xml",

			 "ゲーム版見るよ！" => "http://miruyo.blog38.fc2.com/?xml",

			 "JKさやの２chまとめ" => "http://afterapg.blog97.fc2.com/?xml",

			 "げんせん１スレ" => "http://ibra.blog52.fc2.com/?xml",

			 "うましかニュース" => "http://umashika-news.jp/index.rdf",

			 "喪ゲ女" => "http://mogeonna.seesaa.net/index.rdf",

			 "しまぱん" => "http://simapan.org/index.rdf",

			 "茶速" => "http://blogrss.shinobi.jp/rss/ninja/chasoku",

			 "すくいぬ" => "http://suiseisekisuisui.blog107.fc2.com/?xml",

			 "VIPワイドガイド" => "http://news4wide.livedoor.biz/index.rdf",

			 "やる夫観察日記" => "http://yaruokansatu.blog44.fc2.com/?xml",

			 "ちょっとアレなニュース" => "http://aresoku.blog42.fc2.com/?xml",

			 "常識的に考えた" => "http://blog.livedoor.jp/jyoushiki43/index.rdf",

			 "ZiNGER-HOLE" => "http://newtou.info/rss.xml",

			 "未定なブログ" => "http://feed.rssad.jp/rss/fc2/aromablack5310.blog77",

			 "引いた瞬間、冷めた瞬間" => "http://phlogiston.blog110.fc2.com/?xml",

			 "KIRA☆SOKU" => "http://kamisoku.blog47.fc2.com/?xml",

			 "日刊スレッドガイド" => "http://guideline.livedoor.biz/index.rdf",

			 "哲学ニュースnwk" => "http://blog.livedoor.jp/nwknews/index.rdf",

			 "みんくちゃんねる" => "http://minkch.com/index.rdf",

			 "ひまねっと - アニメ" => "http://himarin.net/archives/cat_105503.xml",

			 "たま速報" => "http://tamasoku.blog35.fc2.com/?xml",

			 "ニュースウォッチ２チャンネル" => "http://nw2.blog112.fc2.com/?xml",

			 "いたしん！" => "http://i.2chblog.jp/index.rdf",

			 "ねたAtoZ" => "http://netaatoz.jp/index.rdf",

			 "VIPPER速報" => "http://vippers.jp/index.rdf",

			 "痛いニュース(ﾉ∀`)" => "http://blog.livedoor.jp/dqnplus/index.rdf",

			 "働くモノニュース : 人生VIP職人ブログ" => "http://workingnews.blog117.fc2.com/?xml",

			 "ワラノート" => "http://waranote.livedoor.biz/index.rdf",

			 "ゴールデンタイムズ" => "http://blog.livedoor.jp/goldennews/index.rdf",

			 "ライフハックちゃんねる弐式" => "http://lifehack2ch.livedoor.biz/index.rdf",

			 "時は来た！それだけだ" => "http://tokihakita.blog91.fc2.com/?xml",

			 "ニコニコVIP2ch" => "http://blog.livedoor.jp/nicovip2ch/index.rdf",

			 "フライドチキンは空をとぶ" => "http://morinogorira.seesaa.net/index.rdf",

			 "はちま起稿" => "http://blog.esuteru.com/index.rdf",

			 "ニュー速VIPコレクション" => "http://2chmokomokocat.blog72.fc2.com/?xml",

			 "咳をしてもゆとり" => "http://yutori2ch.blog67.fc2.com/?xml",

			 "ぷん太のにゅーす" => "http://punpunpun.blog107.fc2.com/?xml",

			 "カゼタカ2ブログch" => "http://kazetaka.com/index.rdf",

			 "萌えオタニュース速報" => "http://otanews.livedoor.biz/index.rdf",

			 "芸スポまとめblog" => "http://blog.livedoor.jp/domesaka/index.rdf",

			 "2ちゃんねる実況中継" => "http://www.res2ch.net/index.rdf",

			 "V速ニュップ" => "http://blog.livedoor.jp/ringotomomin/index.rdf",

			 "ブラブラブラウジング" => "http://brow2ing.doorblog.jp/index.rdf",

			 "ほんわか2ちゃんねる" => "http://honwaka2ch.livedoor.biz/index.rdf",

			 "VIPってなんぞ？" => "http://vip0nanzo.blog109.fc2.com/?xml",

			 "のとーりあす" => "http://notorious2.blog121.fc2.com/?xml",

			 "妹はVIPPER" => "http://vipsister23.com/index.rdf",

			 "社会生活VIP" => "http://minisoku.blog97.fc2.com/?xml",

			 "SLPY" => "http://slpy.blog65.fc2.com/?xml",

			 "犬速VIP" => "http://inusoku.blog87.fc2.com/?xml",

			 "中の人" => "http://nakasoku.blog18.fc2.com/?xml",

			 "育児板拾い読み@2ch+" => "http://blog.livedoor.jp/ikuzi2p/index.rdf",

			 "やらおん！" => "http://yaraon.blog109.fc2.com/?xml",

			 "はれぞう" => "http://blog.livedoor.jp/darkm/index.rdf",

			 "まめ速" => "http://mamesoku.com/index.rdf",

			 "もみあげチャ〜シュ〜" => "http://michaelsan.livedoor.biz/index.rdf",

			 "きっちり速報" => "http://blog.livedoor.jp/kicchiri_news/index.rdf",

			 "【2ch】ニュー速クオリティ" => "http://news4vip.livedoor.biz/index.rdf",

			 "カナ速" => "http://feeds.fc2.com/fc2/xml?host=kanasoku.blog82",

			 "VIPPERな俺" => "http://blog.livedoor.jp/news23vip/index.rdf",

			 "BIPブログ" => "http://bipblog.com/index.rdf",

			 "無題のドキュメント" => "http://www.mudainodocument.com/index.rdf",

			 "ハムスター速報" => "http://hamusoku.com/index.rdf",

			 "アルファルファモザイク" => "http://alfalfalfa.com/index.rdf",

			 "暇人＼(^o^)／速報" => "http://himasoku.com/index.rdf",

			 "２のまとめＲ" => "http://2r.ldblog.jp/index.rdf",

			 "ぶる速-VIP" => "http://burusoku-vip.com/index.rdf",

			 "ぁゃιぃ(*ﾟーﾟ)NEWS 2nd" => "http://ayacnews2nd.com/index.rdf",

			 "あじゃじゃしたー" => "http://blog.livedoor.jp/chihhylove/index.rdf",

			 "ワロタニッキ" => "http://blog.livedoor.jp/hisabisaniwarota/index.rdf",

			 "【2ch】コピペ情報局" => "http://news.2chblog.jp/index.rdf",

			 "もみあげチャ～シュ～" => "http://michaelsan.livedoor.biz/index.rdf",

			 "2chコピペ保存道場" => "http://2chcopipe.com/index.rdf",

			 "まとめたニュース" => "http://matometanews.com/index.rdf",

			 "ニュース２ちゃんねる" => "http://news020.blog13.fc2.com/?xml",

			 "マジキチ速報" => "http://majikichi.com/index.rdf",

			 "キニ速" => "http://blog.livedoor.jp/kinisoku/index.rdf",

			 "カオスちゃんねる" => "http://chaos2ch.com/index.rdf",

			 "がぞ～速報" => "http://stalker.livedoor.biz/index.rdf",

			 "TRTR（・Д・；）" => "http://blog.livedoor.jp/roadtoreality/index.rdf",

			 "私女だけど" => "http://watashe.blog135.fc2.com/?xml",

			 "watch@2ちゃんねる" => "http://www.watch2chan.com/index.rdf",

			 "ブラブラブラウジング" => "http://brow2ing.doorblog.jp/index.rdf",

			 "なんだかおもしろい" => "http://blog.livedoor.jp/zakuzaku911/index.rdf",

			 "デジタルニューススレッド" => "http://digital-thread.com/index.rdf",

			 "黒マッチョニュース" => "http://kuromacyo.livedoor.biz/index.rdf",

			 "アクアカタリスト" => "http://aqua2ch.net/index.rdf",*/
			);

			return $urls;
		}


}
