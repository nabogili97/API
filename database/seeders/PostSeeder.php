<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $post = new Post();
        $post->category_id = rand(1, 9);
        $post->title = 'Top 11 giày chạy bộ Adidas tốt nhất năm 2022';
        $post->description = 'Adidas là một trong những thương hiệu nổi tiếng nhất thế giới. Adidas được nhiều người dùng biết đến bởi các sản phẩm chất lượng cao, mẫu mã đa dạng, phạm vi người dùng luôn mở rộng… Adidas đã trở thành một tập đoàn chuyên sản xuất các mặt hàng thời trang chuyên về phong cách thể thao lớn thứ hai trên thế giới. Nhất là các mẫu giày chạy bộ Adidas rất được các bạn trẻ Việt Nam ưa chuộng.王';
        $post->content = '1.Lý giải sức hút của giày chạy bộ Adidas. Boost trong tiếng Anh nghĩa là tăng cường. Công nghệ Boost được hãng Adidas giới thiệu vào năm 2003 với đặc điểm nổi bật là công nghệ nén hạt nhựa mới lại theo khung mẫu giày. Theo Adidas, loại nhựa hoàn toàn mới này có ưu điểm là khả năng chịu nhiệt tốt, nhẹ, bền và độ đàn hồi cao.'
           ;
        $post->img = 'https://backend-cdn.vortexs.io/api/images/6513595e-261c-4b20-beef-27ce3372cf8e/1920/w/giay-chay-bo-adidas';
        $post->viewed = rand(80, 1000);
        $post->public_end_at = $faker->date();
        $post->public_start_at = $faker->date();
        if (rand(1, 2) == 1) {
            $post->status = Post::STATUS_POST_ENABLED;
        } else {
            $post->status = Post::STATUS_POST_DISABLE;
        }
        $post->save();

        $post = new Post();
        $post->category_id = rand(1, 9);
        $post->title = 'Thanh Lý Giày Thể Thao Nữ với 3 địa điểm tại HN';
        $post->description = 'Giày là một item thời trang không thể thiếu trong tủ đồ của các bạn nữ. Hiện nay, xu hướng mua giày thanh lý và giày second-hand đang ngày càng trở nên phổ biến do sự tối ưu về giá cả cũng như chất lượng. Nếu lựa chọn kỹ càng, bạn sẽ dễ dàng chọn được cho mình một đôi giày giá rẻ với chất lượng vô cùng ổn định. Nhưng bạn đã biết cửa hàng nào thanh lý giày thể thao nữ chưa? Cùng Minhshop điểm qua 3 cái tên phổ biến nhất ở thành phố Hồ Chí Minh. ';
        $post->content = '1. Cửa hàng giày BÈO Store Là cái tên đứng đầu trong cuộc thi bình chọn shop giày thể thao second-hand uy tín nhất, cái tên BÈO Store đã trở thành một trong những địa điểm thanh lý giày thể thao nữ được nhiều bạn gái ưa chuộng và tin tưởng. Ở BÈO, bạn có thể lựa chọn được rất nhiều mẫu giày chất lượng với giá thành cạnh tranh. Thậm chí, nhiều mẫu giày ở đây còn được các shop khác mua về và bán lại với giá cao hơn rất nhiều. Vì thế, điều duy nhất khiến chúng ta lo lắng ở đây chính là nếu không đến trước, các mẫu giày đẹp rất nhanh sẽ bị người khác lấy mất. 2. Cửa hàng giày Burn Shop
        Nhắc đến những cửa hàng thanh lý giày thể thao nữ nổi tiếng ở thành phố Hồ Chí Minh thì chắc chắn Burn Shop sẽ là một trong những cái tên đứng đầu. Đây là cửa hàng chuyên thanh lý các loại giày second-hand, giày cũ đến từ nhiều thương hiệu vô cùng nổi tiếng trên thế giới như Nike, Adidas, Converse, Timber, FILA, Jordan… với giá thành cạnh tranh và chất lượng vô cùng ổn định. Chính vì thế, Burn Shop cũng chính là một trong những địa chỉ luôn được khách hàng tin tưởng và ghé đến hiện nay.';
        $post->img = 'https://cdn.vortexs.io/api/images/2bc0e3f4-ca33-496a-aa3d-045eaf7229bb/1920/w/thanh-ly-giay-the-thao-nu-voi-3-dia-diem-tai-tp-ho-chi-minh.jpeg';
        $post->viewed = rand(80, 1000);
        $post->public_end_at = $faker->date();
        $post->public_start_at = $faker->date();
        if (rand(1, 2) == 1) {
            $post->status = Post::STATUS_POST_ENABLED;
        } else {
            $post->status = Post::STATUS_POST_DISABLE;
        }
        $post->save();

        $post = new Post();
        $post->category_id = rand(1, 9);
        $post->title = 'Nên mua giày thể thao hãng nào? Top 16+ hãng giày nổi tiếng, luôn "cháy hàng" trên toàn thế giới năm 2022';
        $post->description = 'Lựa chọn một mẫu giày phù hợp với nhu cầu và sở thích của bản thân thường là một vấn đề nhiều nan giải với nhiều tiêu chí cần cân nhắc. Chính vì vậy, người dùng thường lựa chọn những thương hiệu có tên tuổi, được bảo chứng về mặt chất lượng mỗi khi cần phải quyết định xuống tay tậu giày. Nay hãy cùng Minhshop điểm qua danh sách những hàng giày có tiếng, luôn “cháy hàng” trên toàn cầu trong năm 2022, để mua được những mẫu giày ưng ý nhất!';
        $post->content = '1. Nike - Lan tỏa sức hút giày thể thao toàn cầu
        Sức hút đặc biệt đến từ Nike - ông trùm ngành giày thể thao


Một trong những thương hiệu giày có sức ảnh hưởng nhất hiện nay chính là Nike. Nổi lên với câu khẩu hiệu “Just Do It” và hình ảnh logo biểu trưng là dấu Swoosh được nhào nặn bởi Carolyn Davidson, thể hiện cho tinh thần xông pha, dám nghĩ dám làm; Nike đang ngày một chứng minh được sức hút của mình khi thu hút được sự quan tâm của hàng loạt ngôi sao, cầu thủ danh giá như Ronaldo, Neymar, Tiger Woods,...


Nike cũng ngày càng ghi điểm với công nghệ tối tân, hiện đại để đem đến trải nghiệm tốt nhất cho những người sử dụng. Một số mẫu giày nổi bật, được ưa chuộng của thương hiệu có thể kể đến là Air Max, Nike Air Jordan hay Nike Air Force 1,..';
        $post->img = 'https://lh6.googleusercontent.com/ALsjey3rKKqDPyZo9O0uNdBEhM1QyRDUf_kBlV5mt9oheUNe4qHzzW8eAchoX6w_xVFZ_tAjzm8HqxPKmaWb478FTtkbF8CItl7EqiYkgy4wx130flBdODwZSttjCuXstQp3xwOa';
        $post->viewed = rand(80, 1000);
        $post->public_end_at = $faker->date();
        $post->public_start_at = $faker->date();
        if (rand(1, 2) == 1) {
            $post->status = Post::STATUS_POST_ENABLED;
        } else {
            $post->status = Post::STATUS_POST_DISABLE;
        }
        $post->save();



        $post = new Post();
        $post->category_id = rand(1, 9);
        $post->title = 'Street style là gì? Top 7 cách giúp bạn xây dựng phong cách đường phố đúng chuẩn';
        $post->description = 'Street style bắt nguồn từ phong cách ăn mặc của 1 nhóm chuyên trượt ván ngoài đường (skater), đậm chất đường phố, bụi bặm. Và đây cũng là phong cách rất quen thuộc với giới trẻ, đặc biệt là những bạn yêu thích sự phá cách, khác biệt. Hãy cùng Minhshop tìm hiểu về phong cách streetwear cũng như các cách phối đồ “chất phát ngất” dành cho tín đồ thời trang nhé.';
        $post->content = '1. Phong cách street style là gì?
Street style dịch sang tiếng Việt nghĩa là phong cách đường phố, dùng để nói đến các phong cách thời trang được bắt gặp trên đường phố, các bạn trẻ rất yêu thích phong cách này, đặc là những người nổi tiếng, các Fashionista hay diện street style càng làm cho phong cách thời trang này hot hơn bao giờ hết.

Phong cách street style bắt nguồn từ 1 nhóm bạn trẻ chơi trượt ván trên đường phố, thể hiện sự thoải mái, năng động, độc đáo và phá cách. Không giống như những phong cách khác, street style đề cao sự ngẫu hứng, năng động và riêng biệt được tô điểm bởi màu sắc cá nhân.';
        $post->img = 'https://backend-cdn.vortexs.io/api/images/c74c6d60-fd1e-4e35-a830-5f282f7ad56b/1920/w/street-style';
        $post->viewed = rand(80, 1000);
        $post->public_end_at = $faker->date();
        $post->public_start_at = $faker->date();
        if (rand(1, 2) == 1) {
            $post->status = Post::STATUS_POST_ENABLED;
        } else {
            $post->status = Post::STATUS_POST_DISABLE;
        }
        $post->save();

        $post = new Post();
        $post->category_id = rand(1, 9);
        $post->title = 'Top 12+ thương hiệu thời trang nam nổi tiếng nhất tại Việt Nam ';
        $post->description = 'Ngoài các chị em phụ nữ, đấng mày râu hiện nay cũng rất chăm sóc đến vẻ bề ngoài và quan tâm đến các phong cách thời trang. Vậy làm sao để lựa chọn được một thương hiệu phù hợp với phong cách, định hướng thời trang của bản thân nhất. Đừng lo, Minhshop sẽ giúp bạn tổng hợp top 12+ thương hiệu thời trang nam nổi tiếng mới nhất hiện nay giúp bạn tìm được thương hiệu phù hợp nhất.';
        $post->content = '1. Top thương hiệu thời trang nam Việt Nam nổi tiếng
1.1 Owen – Thương hiệu thời trang tạo nên sự lịch lãm
Owen hiện đang là một trong top các thương hiệu thời trang nam nổi tiếng hàng đầu tại Việt Nam. Hãng thời trang Owen thuộc tập đoàn "Thời trang Kowil Việt Nam". Là cái tên vẫn còn khá mới trên thị trường nhưng thương hiệu này đã và đang được đông đảo khách hàng ưa chuộng.

Owen mang đến cho người tiêu dùng một loạt các sản phẩm với mẫu mã đa dạng, màu sắc độc đáo, chinh phục được khách hàng nam với dòng thời trang công sở cao cấp, chất lượng. Thương hiệu luôn không ngừng tìm tòi, sáng tạo nhằm mang đến cho nam giới Việt giải pháp thời trang có tính ứng dụng cao, tạo dựng được sự lịch lãm, tự tin và đầy nam tính, đáp ứng nhu cầu cho các quý ông.

Hoạt động từ năm 2008 đến nay, thương hiệu thời trang nam Owen hiện đã xây dựng được mạng lưới phân phối sản phẩm có mặt trên toàn quốc, với gần 1,000 điểm kinh doanh bao gồm đại lý và hệ thống cửa hàng bán lẻ.';
        $post->img = 'https://cdn.vortexs.io/api/images/4ebfbf18-13b7-4631-be29-8a6e5358c5e1/1920/w/top-12-thuong-hieu-thoi-trang-nam-noi-tieng-nhat-tai-viet-nam-minhshop.jpeg';
        $post->viewed = rand(80, 1000);
        $post->public_end_at = $faker->date();
        $post->public_start_at = $faker->date();
        if (rand(1, 2) == 1) {
            $post->status = Post::STATUS_POST_ENABLED;
        } else {
            $post->status = Post::STATUS_POST_DISABLE;
        }
        $post->save();

        $post = new Post();
        $post->category_id = rand(1, 9);
        $post->title = 'Cách phối đồ nam đẹp: Quy tắc và Concept mix đồ đơn giản - đón đầu xu hướng thời trang 2022 ';
        $post->description = 'Cách phối đồ nam đơn giản nhưng vẫn đẹp và “có gu”? Mix đồ cho nam như thế nào để đón đầu xu hướng thời trang trong năm 2022 sắp tới? Hãy đọc ngay bài viết dưới đây vì Minhshop sẽ đem đến cho bạn những kiểu phối đồ nam vừa đơn giản vừa hiệu quả cũng như các concept độc và lạ để bạn có thể dễ dàng làm chủ phong cách thời trang của mình.';
        $post->content = '1. 9 quy tắc phối đồ nam đẹp bạn cần biết
Biết và áp dụng được các quy tắc cơ bản luôn là điều cần thiết nhất trong việc mix đồ. Đối với phối đồ cho nam thì các quy tắc này càng quan trọng nếu bạn không muốn trang phục của mình trở nên quá “lố” hay mắc các lỗi ngớ ngẩn.

Trong bài viết này, Minhshop sẽ cung cấp cho bạn 9 quy tắc cơ bản nhất mà bạn cần phải nhớ để có những set đồ nam đẹp.

1.1 Ghi nhớ nguyên tắc phối màu trang phục
Có rất nhiều các nguyên tắc trong việc phối màu trang phục, đặc biệt là trong phối đồ nam. Trong đó, 5 quy tắc dưới đây là những điều cơ bản nhất bạn cần phải nhớ.

Hiểu quy luật và sử dụng được bánh xe màu sắc khi phối màu trang phục
Sử dụng các màu liền kề khi phối đồ cho nam để tăng sự hài hoà và lịch sự
Sử dụng các màu tương phản làm nổi bật sự cá tính và năng động
Sử dụng các màu tương phản bổ sung trong concept độc lạ hoặc các cách mix đồ táo bạo
Sử dụng 3 màu cách đều nhau để tạo nên sự mới lạ nhưng vẫn giữ được tính hài hoà và liên kết


Áp dụng các quy tắc phối màu trên trang phục

1.2 Không nên cài nút dưới của vest/ blazer
Các bộ suits đã trở thành một vật không thể thiếu trong bộ đồ của mỗi quý ông trong các dịp quan trọng. Việc mặc suits sao cho đúng và chuẩn có rất nhiều quy tắc.

Trong đó, điều cơ bản nhất trong tất cả các cách phối đồ nam là không được cài khuy áo cuối cùng khi bạn mặc suits. Việc này sẽ giúp bộ trang phục của bạn trở nên thoải mái, phong độ hơn và bớt cảm giác tù bí, chật hẹp. Nếu hàng khuy có 3 nút thì bạn có thể cài hai nút trên và trừ ra khuy cuối cùng.



Đừng cài khuy cuối cùng trên suits

1.3 Đừng giặt các bộ suits quá nhiều
Để giữ cho các bộ suits được đứng dáng, chuẩn form và cũng như chất suits luôn mềm mại, thẳng thớm thì bạn phải chú ý đến cách làm sạch các bộ suits sao cho chuẩn.

Đừng mang các bộ suits đến tiệm giặt là quá nhiều, thay vào đó hãy dành thời gian để tự mình làm sạch và bảo quản. Sử dụng loại móc chuyên dụng thay cho việc gấp gọn cũng góp phần giúp bộ suits của bạn luôn được đứng dáng và phẳng phiu.

';
        $post->img = 'https://cdn.vortexs.io/api/images/63c478fd-460c-46a4-8a61-2aa431681801/1920/w/cach-phoi-do-nam-dep-quy-tac-va-concept-mix-do-don-gian-don-dau-xu-huong-thoi-trang-2022.jpeg';
        $post->viewed = rand(80, 1000);
        $post->public_end_at = $faker->date();
        $post->public_start_at = $faker->date();
        if (rand(1, 2) == 1) {
            $post->status = Post::STATUS_POST_ENABLED;
        } else {
            $post->status = Post::STATUS_POST_DISABLE;
        }
        $post->save();


    }
}
