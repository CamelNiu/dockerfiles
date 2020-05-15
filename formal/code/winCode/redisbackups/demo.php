<?php
//信号处理需要注册ticks才能生效，这里务必注意
//PHP5.4以上版本就不再依赖ticks了

require "./rds.php";

$rds = new rds();

while (true) {

    $res = $rds->brpop('niu',5);

    if( empty($res) ) continue;

    $key = $res[0];
    $value = $res[1];

    $pid = pcntl_fork();

    if ($pid == -1) {
       continue;
    } elseif ($pid) {

    } else {

      sumProcess($key,$value);

      exit();
    }

}




function sumProcess($key,$value)
{
    $gid = posix_getpid();

    $fileName = $value."_".$gid;
    $content = "余从京域，言归东藩。背伊阙，越轘辕，经通谷，陵景山。日既西倾，车殆马烦。尔乃税驾乎蘅皋，秣驷乎芝田，容与乎阳林，流眄乎洛川。于是精移神骇，忽焉思散。俯则未察，仰以殊观，睹一丽人，于岩之畔。乃援御者而告之曰：尔有觌于彼者乎？彼何人斯？若此之艳也！”御者对曰：臣闻河洛之神，名曰宓妃。然则君王所见，无乃是乎？其状若何？臣愿闻之。".PHP_EOL;
    for($i=0;$i<1;$i++){
      file_put_contents("./testfile/".$fileName,$content,FILE_APPEND);
    }
    sleep(5);
}