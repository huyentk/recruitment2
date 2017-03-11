<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Vietnam Esports',
            'slogan' => 'Dám mơ. Dám nghĩ. Dám làm.',
            'description' => 'Những viên gạch nền đầu tiên của Vietnam Esports được xây nên từ một nhóm các chàng trai trẻ, ấp ủ khát khao phát triển nền thể thao điện tử chuyên nghiệp tại Việt Nam.\n
                             Vào thời điểm đó, e-Sports còn rất mới mẻ và chưa nhận được sự ủng hộ của xã hội. \n
                             Chính vì thế Vietnam Esports đã không ngừng nỗ lực xây dựng hình ảnh một nền thể thao điện tử lành mạnh, được đầu tư nghiêm túc, trả lại đúng nghĩa khái niệm “e-Sports”.\n
                             Trải qua hơn 6 năm xây dựng, Vietnam Esports đã phát triển mạnh mẽ với niềm đam mê của những người sáng lập và sự chung tay góp sức của hơn 1000 nhân viên. \n
                             Từ một văn phòng nhỏ ở Hà Nội vào những ngày đầu mới thành lập, hiện nay Vietnam Esports đã có văn phòng ở 3 miền và trên 50 trung tâm chăm sóc khách hàng khắp cả nước.',
            'address' => 'Tòa nhà Vietnam Esports, 15 Trương Định, Phường 6, Quận 3, Tp. Hồ Chí Minh.',
            'url' => 'http://vietnamesports.vn/',
            'num_employee' => '300.000'
        ]);
        Company::create([
            'name' => 'FPT',
            'slogan' => 'The leading provider of software outsourcing services in Vietnam',
            'description' => 'Established in 1999, ranking in Top 100 Global Outsourcing, recognized as Top Best IT Company To Work in Vietnam (2014), FPT Software is a global software company with presence in US, Japan, EU, Asia Pacific and Australia.\n 
                            FPT Software staff take pride in fair competition with work quality equal to that of the world’s 500 biggest companies’ staff in central area of technology such as Mobility, Cloud Computing, Big Data... \n
                            Annually, thousands of staff have gone on business trips overseas.\n
                            FPT Software‘s members consist of Vietnam, US, Japan, EU, Slovakia, Singapore, Myanmar‘s citizens. Though from different origins, they all share the common mission of turning FPT Software into one of the world’s leading software companies.\n 
                            You can make it too!',
            'address' => 'Tòa nhà Vietnam Esports, 15 Trương Định, Phường 6, Quận 3, Tp. Hồ Chí Minh.',
            'url' => 'http://www.fpt.vn/',
            'num_employee' => '300.000'
        ]);
    }
}
