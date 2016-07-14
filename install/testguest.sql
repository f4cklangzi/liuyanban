-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-07-14 11:09:55
-- 服务器版本： 5.7.13
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testguest`
--

-- --------------------------------------------------------

--
-- 表的结构 `tg_article`
--

CREATE TABLE `tg_article` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//ID',
  `tg_reid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//主题ID',
  `tg_username` varchar(20) NOT NULL COMMENT '//发帖人',
  `tg_type` tinyint(2) UNSIGNED NOT NULL COMMENT '//帖子类型',
  `tg_title` varchar(40) NOT NULL COMMENT '//标题',
  `tg_content` text NOT NULL COMMENT '//内容',
  `tg_nice` tinyint(2) UNSIGNED DEFAULT '0' COMMENT '//是否设置精华',
  `tg_readcount` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//阅读次数',
  `tg_commendcount` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//评论次数',
  `tg_last_modify_date` datetime NOT NULL COMMENT '//最后修改时间',
  `tg_last_modify_username` varchar(20) DEFAULT NULL COMMENT '//最后修改人',
  `tg_date` datetime NOT NULL COMMENT '//发帖时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_article`
--

INSERT INTO `tg_article` (`tg_id`, `tg_reid`, `tg_username`, `tg_type`, `tg_title`, `tg_content`, `tg_nice`, `tg_readcount`, `tg_commendcount`, `tg_last_modify_date`, `tg_last_modify_username`, `tg_date`) VALUES
(1, 0, 'administrator', 6, 'my frist article', '这篇文章的内容有点少~~~但是这是第一篇文章哦！', 0, 135, 2, '2016-04-07 15:02:48', NULL, '2016-03-28 16:55:37'),
(2, 0, 'administrator', 3, '[Android] QQ附近的人自动打招呼名片点赞新鲜事点赞QQ空间点赞', '辅助功能介绍: 推荐使用靠谱助手的天天模拟器进行全国定位使用\r\n 1、支持自动打招呼，定义打招呼内容（可随机不同内容） \r\n2、支持选择只看男生，只看女生，查看全部 \r\n3、支持自定义需要打招呼的人数 \r\n4、即将支持自动点赞附近名片、点赞新鲜事、点赞QQ空间动态 暂小米3、模拟器720*1280分辨率320DPI可用 （本工具采用按键精灵安卓版编写，纯模拟触屏点击操作） \r\n【使用注意事项】 \r\n1、手机必须ROOT并授权按键精灵才能正常使用本工具。\r\n2、小米(MIUI)用户仅支持开发版（必须有最高权限授权），并手机设置的应用中开启悬浮窗。 \r\n3、仅支持安卓4.0以上的系统\r\n[img]http://localhost/liuyanban/article.php?id=1[/img]', 0, 53, 3, '2016-05-06 20:31:02', 'administrator', '2016-03-31 13:20:02'),
(3, 0, 'study-php', 10, '红红的火苗真呀真漂亮~~', '[size=24]24号字体[/size]\n[b]这是加粗的内容[/b]\n[i]这是斜体[/i]\n[u]这是下划线[/u]\n[s]这是删除线[/s]\n[color=#f60]颜色是#f60[/color]\n超链接：[url]http://2book.tech[/url]\n邮件地址[email]f4ck_langzi@foxmail.com[/email]\n图片插入：[img]http://www.52pojie.cn/static/image/common/logo.png[/img]\nflash插入：[flash]http://player.youku.com/player.php/sid/XMTUxNTcwMjQ4NA==/v.swf[/flash]', 0, 42, 0, '0000-00-00 00:00:00', NULL, '2016-03-31 18:18:08'),
(4, 0, 'study-php', 4, '一首好听的音乐送给大家', '心雨：[flash]http://sc.111ttt.com/up/mp3/213051/25E34819D75FE63D97608A455438B1EE.mp3[/flash]', 0, 19, 0, '0000-00-00 00:00:00', NULL, '2016-03-31 19:57:00'),
(5, 0, '罗灿', 10, '苹果公司要求FBI公布破解iPhone的技术细节', '[img]http://www.trbimg.com/img-56fb4421/turbine/la-ap685014729866-jpg-20160329/750/750x422[/img]\r\n苹果公司之前拒绝了FBI要求其帮助破解嫌犯iPhone的请求，但是现在，苹果却需要FBI的协助。\r\nFBI星期一宣布，在没有苹果公司帮助的情况下，已经成功破解了San Bernardino枪击案凶手的iPhone 5C手机，\r\n但是FBI表示，目前并没有兴趣告诉苹果公司FBI是如何绕过了iphone的安全功能，苹果公司认为FBI的这一举动将可能使此漏洞继续危害数以百万计的设备。\r\nFBI成功破解了iPhone,这会使你的手机不再拥有隐私吗？\r\n此次FBI与苹果的对立事件，与之前曝光的隐私事件所不同的是，从一开始整个世界就关注着这个事情的发展。\r\n去年12月，Syed Rizwan Farook和他的妻子杀害了14位市民，政府公开寻求法院命令来迫使苹果去解锁Farook的手机。然而，苹果拒绝执行这个命令，这也加剧了硅谷和执法部门之间紧张的对立局面。\r\n目前，FBI已经撤消了对苹果的法律诉讼，不过FBI目前陷入了新的伦理窘境：是否有义务告知这些科技公司他们产品中的缺陷，使其进行完善。或者，执法部门是否有权将这些漏洞当作打击犯罪的武器？\r\n目前并不清楚FBI的破解技术能否适用于其它版本的iPhone手机，不过一位不愿意透露姓名的执法人员说，这项破解技术是有局限性的。\r\n一些新闻媒体援引匿名消息来源，称已经确认，以色列手机信息提取公司Cellebrite就是这次参与协助FBI破解iPhone的第三方，但是此公司和FBI都没有证实这则消息。\r\n一位未经授权的消息人士，向泰晤士报透露，FBI所获得的这项技术可以让它实现即便连续输入10次错误密码，手机也不会永久性的删除自身数据。使用此技术，FBI可以通过解锁软件去遍历所有的可能密码组合，直到它找到正确的密码。\r\n我们目前还不清楚FBI是否从该嫌疑犯的手机里提取出了什么有用信息，当然，提取的前提是它真的存在。\r\n苹果与FBI的斗争\r\n苹果的律师正在研究如何使用法律手段，去迫使政府移交相关的技术细节，但是直到星期二，苹果公司仍没有更新其进展。\r\nFBI可以以“最关键的技术细节涉及到保密”协议，将其技术牢牢掌握在协助它的第三方公司的手里，或者说只有等到调查完全结束才可以公开等等这些理由为由，为自己辩护。\r\n许多专家认为，政府并没有明显的法律义务向苹果提供技术细节。但是专业的安全研究人员认为，在一个计算机在商业和沟通过程中起着至关重要的作用的时代，网络安全漏洞随处可见的情况不应该出现。\r\n白宫的网络安全负责人也承认，在多数情况下，相比政府在私底下通过偷偷利用漏洞来协助调查所带来的安全，人们被未修补的安全问题伤害到的风险要大得多。\r\n目前，白宫正秘密领导一个判断企业是否会被告知其潜在漏洞的项目。\r\n一个名为“漏洞公正处理”（Vulnerabilities Equities Process）的多部门审议机构会根据美国联邦文件，去判断保密漏洞的风险和好处。他们在权衡时会考虑政府是否能从其它途径获取信息，其他人有多大可能会发现这个漏洞等等这些问题。\r\n一些联邦官员坚称，在大多数情况下，他们更倾向于私下将这些新发现的漏洞告知那些被涉及到的企业。\r\n但在个别情况下，联邦机构显然也已从一些软件开发者留下的此前未知的编程疏忽中，获得了一定的利益。\r\n有相关报道指出，当一些个人研究者在2014年揭露并指控FBI利用洋葱浏览器的bug来确认犯罪嫌疑人之前，美国国家安全局就已经秘密利用这个漏洞，从网站上获取敏感数据长达两年之久。不过美国国家安全局否认了此消息。\r\n苹果的焦虑也是情有可原的，毕竟没有一家科技公司会希望看到它的产品出现任何大的安全漏洞。在通常情况下，安全方面的研究员们如果发现了一些漏洞，他们会在向所有人公开这些漏洞的几个月前，先警告那些被涉及到的公司，好让他们有充足的时间去修复它们。\r\n这就是为什么苹果公司认为政府应该承担道德上的义务，透漏破解iphone的技术细节。\r\n    “苹果公司最好的方法是找一个具有说服力的例子，将公布这项破解技术的必要划归到涉及国家安全利益的范畴，如果这项破解技术没有公布，可能将会让无辜的用户承担数据泄露的风险”，ACG公司的Olsson说。\r\n苹果在法庭文件中表示，苹果高管担心如果开发相应的软件去绕过iphone的安全功能，此软件可能最终会落到错误的人手中。同样的论点可以适用于这项黑客技术的公布，苹果可公开声明政府和第三方组织不能完美地保护这项技术。\r\n去年，一家经营买卖漏洞的意大利公司亲眼目睹了它的整个数据库被泄露到互联网上。而同样的安全问题也可以解释FBI和外界团队为何要如此秘密地保护这些黑客破解安全防护的过程。\r\nFBI将于警方分享iPhone的破解技术吗？可能不会\r\n安全战略和威胁情报副总裁Kevin Bocek说：\r\n    “现在也有人担心，既然Iphone是可以被破解，那么更多的人将会去尝试破解它。iphone一直以来被认为是一个小小的诺克斯堡（联邦政府黄金储备的贮存处），从外面很难进入其中。”\r\nRSA下属的先进网络防卫团队的一位总经理陈彼德（Peter Tran）说：\r\n    “此次苹果和FBI对立事件的发展，改变了我们一贯的认知，它唤醒了许多之前只做小活的网络罪犯和业余黑客。”\r\n虽然这位帮助FBI破解iPhone的神秘人士很可能已经从FBI那儿拿到了正义的小费，但其他偶然发现了这个黑客技术的人也可以选择将它卖给网络小偷或者是别国的政府。鲍谢克表示，在东欧有一个势力庞大的地下网络黑市，他们每天都会从事类似的勾当。\r\n苹果通常不会用现金去奖励漏洞发现者。但基于这次事件的影响范围之大，专家表示，苹果可能也会转向地下网络黑市。\r\nZimperium的一位移动安全研究者Nikias Bassen说：\r\n    “这又一次向我们证明了一点，即便存在你不懂的东西，你也可以通过花钱去解决它。”\r\n\r\n[size=10]原文地址：[url]http://www.freebuf.com/news/100524.html[/url][/size]', 1, 14, 0, '0000-00-00 00:00:00', NULL, '2016-03-31 20:13:46'),
(6, 0, '罗灿', 8, '技术分享：如何用Solr搭建大数据查询平台', '[img]http://image.3001.net/images/20160330/14593152357650.jpg!small[/img]\r\n[color=#000080]*原创作者：b41k3r[/color]\r\n[size=16]0×00 开头照例扯淡[/size]\r\n自从各种脱裤门事件开始层出不穷，在下就学乖了，各个地方的密码全都改成不一样的，重要帐号的密码定期更换，生怕被人社出祖宗十八代的我，甚至开始用起了假名字，我给自己起一新网名”兴才”，这个看起来还不错的名字，其实是我们家乡骂人土话，意思是脑残人士…. -_-|||额好吧，反正是假的，不要在意这些细节。\r\n这只是名，至于姓氏么，每个帐号的注册资料那里，照着百家姓上赵钱孙李周吴郑王的依次往下排，什么张兴才、李兴才、王兴才……于是也不知道我这样”兴才”了多久，终于有一天，我接到一个陌生电话：您好，请问是马兴才先生吗?\r\n好么，该来的终于还是来了，于是按名索骥，得知某某网站我用了这个名字，然后通过各种途径找，果然，那破站被脱裤子了。\r\n果断Down了那个裤子，然后就一发不可收拾，走上了收藏裤子的不归路，直到有一天，我发现收藏已经非常丰富了，粗略估计得好几十亿条数据，拍脑袋一想，这不能光收藏啊，我也搭个社工库用吧……\r\n[size=16]0×01 介绍[/size]\r\n社工库怎么搭呢，这种海量数据的东西，并不是简单的用mysql建个库，然后做个php查询select * from sgk where username like ‘%xxxxx%’这样就能完事的，也不是某些幼稚骚年想的随便找个4g内存，amd双核的破电脑就可以带起来的，上面这样的语句和系统配置，真要用于社工库查询，查一条记录恐怕得半小时。好在这个问题早就被一种叫做全文搜索引擎的东西解决了，更好的消息是，全文搜索引擎大部分都是开源的，不需要花钱。\r\n\r\n目前网上已经搭建好的社工库，大部分是mysql+coreseek+php架构，coreseek基于sphinx，是一款优秀的全文搜索引擎，但缺点是比较轻量级，一旦数据量过数亿，就会有些力不从心，并且搭建集群做分布式性能并不理想，如果要考虑以后数据量越来越大的情况，还是得用其他方案，为此我使用了solr。\r\n\r\nSolr的基础是著名的Lucene框架，基于java，通过jdbc接口可以导入各种数据库和各种格式的数据，非常适合开发企业级的海量数据搜索平台，并且提供完善的solr cloud集群功能，更重要的是，solr的数据查询完全基于http，可以通过简单的post参数，返回json,xml,php,python,ruby,csv等多种格式。\r\n\r\n以前的solr，本质上是一组servlet，必须放进Tomcat才能运行，从solr5开始，它已经自带了jetty，配置的好，完全可以独立使用，并且应付大量并发请求，具体的架构我们后面会讲到，现在先来进行solr的安装配置。\r\n0×02 安装和配置\r\n\r\n以下是我整个搭建和测试过程所用的硬件和软件平台，本文所有内容均在此平台上完成：\r\n\r\n软件配置: solr5.5,mysql5.7,jdk8,Tomcat8  Windows10/Ubuntu14.04 LTS\r\n\r\n硬件配置: i7 4770k,16G DDR3,2T西数黑盘\r\n2.1  mysql数据库\r\n\r\nMysql数据库的安装和配置我这里不再赘述，只提一点，对于社工库这种查询任务远远多于插入和更新的应用来说，最好还是使用MyISAM引擎。\r\n搭建好数据库后，新建一个库，名为newsgk，然后创建一个表命名为b41sgk,结构如下：\r\n\r\n    id  bigint 主键 自动增长\r\n\r\n    username varchar 用户名\r\n\r\n    email varchar 邮箱\r\n\r\n    password varchar 密码\r\n\r\n    salt varchar 密码中的盐或者第二密码\r\n\r\n    ip varchar  ip、住址、电话等其他资料\r\n\r\n    site varchar 数据库的来源站点\r\n\r\n接下来就是把收集的各种裤子全部导入这个表了，这里推荐使用navicat，它可以支持各种格式的导入，具体过程相当的枯燥乏味,需要很多的耐心，这里就不再废话了，列位看官自己去搞就是了，目前我初步导入的数据量大约是10亿条。\r\n2.2 Solr的搭建和配置\r\n\r\n首先下载solr：\r\n\r\n$ wget http://mirrors.hust.edu.cn/apache/lucene/solr/5.5.0/solr-5.5.0.tgz\r\n\r\n解压缩：\r\n\r\n$ tar zxvf solr-5.5.0.tgz\r\n\r\n安装jdk8：\r\n\r\n$ sudo add-apt-repository ppa:webupd8team/java\r\n$ sudo apt-get update\r\n$ sudo apt-get install oracle-java8-installer\r\n$ sudo apt-get install oracle-java8-set-default\r\n\r\n因为是java跨平台的，Windows下和linux下solr是同一个压缩包，windows下jdk的安装这里不再说明。\r\n\r\n进入解压缩后的solr文件夹的bin目录，solr.cmd和solr分别是windows和linux下的启动脚本：\r\n[img]http://image.3001.net/images/20160330/14593103105473.png!small[/img]\r\n因为社工库是海量大数据，而jvm默认只使用512m的内存，这远远不够，所以我们需要修改，打开solr.in.sh文件，找到这一行：\r\n\r\nSOLR_HEAP=”512m”\r\n\r\n依据你的数据量，把它修改成更高，我这里改成4G，改完保存. 在windows下略有不同，需要修改solr.in.cmd文件中的这一行：\r\n\r\nset SOLR_JAVA_MEM=-Xms512m -Xmx512m\r\n\r\n同样把两个512m都修改成4G。\r\n\r\nSolr的启动，重启和停止命令分别是：\r\n\r\n$ ./solr start\r\n$ ./solr restart –p 8983\r\n$ ./solr stop –all\r\n[img]http://image.3001.net/images/20160330/14593103857646.png!small[/img]\r\n在linux下还可以通过install_solr_service.sh脚本把solr安装为服务，开机后台自动运行。\r\n\r\nSolr安装完成，现在我们需要从mysql导入数据，导入前，我们需要先创建一个core，core是solr的特有概念，每个core是一个查询、数据,、索引等的集合体，你可以把它想象成一个独立数据库，我们创建一个新core：\r\n\r\n在solr-5.5.0/server/solr子目录下面建立一个新文件夹，命名为solr_mysql，这个是core的名称，在下面创建两个子目录conf和data，把solr-5.5.0/solr-5.5.0/example/example-DIH/solr/db/conf下面的所有文件全部拷贝到我们创建的conf目录中.接下来的配置主要涉及到三个文件， solrconfig.xml， schema.xml和db-data-config.xml。\r\n\r\n首先打开db-data-config.xml，修改为以下内容：\r\n\r\n<dataConfig>\r\n  <dataSource name="sgk" type="JdbcDataSource" driver="com.mysql.jdbc.Driver" url="jdbc:mysql://127.0.0.1:3306/newsgk" user="root" password="password" batchSize="-1" />\r\n  <document name="mysgk">\r\n    <entity name="b41sgk" pk="id" query="select * from b41sgk">\r\n        <field column="id" name="id"/>\r\n        <field column="username" name="username"/>\r\n        <field column="email" name="email"/>\r\n        <field column="password" name="password"/>\r\n        <field column="salt" name="salt"/>\r\n        <field column="ip" name="ip"/>\r\n        <field column="site" name="site"/>\r\n    </entity>\r\n  </document>\r\n</dataConfig>\r\n\r\n这个文件是负责配置导入数据源的，请按照mysql实际的设置修改datasource的内容，下面entity的内容必须严格按照mysql中社工库表的结构填写，列名要和数据库中的完全一样。\r\n\r\n然后打开solrconfig.xml，先找到这一段：\r\n\r\n  <schemaFactory class="ManagedIndexSchemaFactory">\r\n    <bool name="mutable">true</bool>\r\n    <str name="managedSchemaResourceName">managed-schema</str>\r\n  </schemaFactory>\r\n\r\n把它全部注释掉，加上一行，改成这样：\r\n\r\n  <!-- <schemaFactory class="ManagedIndexSchemaFactory">\r\n    <bool name="mutable">true</bool>\r\n    <str name="managedSchemaResourceName">managed-schema</str>\r\n  </schemaFactory>-->\r\n  <schemaFactory class="ClassicIndexSchemaFactory"/>\r\n\r\n这是因为solr5 以上默认使用managed-schema管理schema，需要更改为可以手动修改。\r\n\r\n然后我们还需要关闭suggest，它提供搜索智能提示，在社工库中我们用不到这样的功能，重要的是，suggest会严重的拖慢solr的启动速度,在十几亿数据的情况下，开启suggest可能会导致solr启动加载core长达几个小时! \r\n\r\n同样在solrconfig.xml中，找到这一段：\r\n\r\n  <searchComponent name="suggest" class="solr.SuggestComponent">\r\n    <lst name="suggester">\r\n      <str name="name">mySuggester</str>\r\n      <str name="lookupImpl">FuzzyLookupFactory</str>      <!-- org.apache.solr.spelling.suggest.fst -->\r\n      <str name="dictionaryImpl">DocumentDictionaryFactory</str>     <!-- org.apache.solr.spelling.suggest.HighFrequencyDictionaryFactory --> \r\n      <str name="field">cat</str>\r\n      <str name="weightField">price</str>\r\n      <str name="suggestAnalyzerFieldType">string</str>\r\n    </lst>\r\n  </searchComponent>\r\n\r\n  <requestHandler name="/suggest" class="solr.SearchHandler" startup="lazy">\r\n    <lst name="defaults">\r\n      <str name="suggest">true</str>\r\n      <str name="suggest.count">10</str>\r\n    </lst>\r\n    <arr name="components">\r\n      <str>suggest</str>\r\n    </arr>\r\n  </requestHandler>\r\n\r\n把这些全部删除，然后保存solrconfig.xml文件。\r\n\r\n接下来把managed-schema拷贝一份，重命名为schema.xml (原文件不要删除)，打开并找到以下位置：\r\n[img]http://image.3001.net/images/20160330/14593106312526.png!small[/img]\r\n只保留_version_和_root_节点，然后把所有的field，dynamicField和copyField全部删除，添加以下的部分：\r\n\r\n   <field name="id" type="int" indexed="true" stored="true" required="true" multiValued="false" />  \r\n   <field name="username" type="text_ik" indexed="true" stored="true"/>\r\n   <field name="email" type="text_ik" indexed="true" stored="true"/>\r\n   <field name="password" type="text_general" indexed="true" stored="true"/>\r\n   <field name="salt" type="text_general" indexed="true" stored="true"/>\r\n   <field name="ip" type="text_general" indexed="true" stored="true"/>\r\n   <field name="site" type="text_general" indexed="true" stored="true"/>\r\n   <field name="keyword" type="text_ik" indexed="true" stored="false" multiValued="true"/>\r\n   \r\n   <copyField source="username" dest="keyword"/>\r\n   <copyField source="email" dest="keyword"/>\r\n   <uniqueKey>id</uniqueKey>\r\n\r\n这里的uniqueKey是配置文件中原有的，用来指定索引字段，必须保留。新建了一个字段名为keyword，它的用途是联合查询，即当需要同时以多个字段做关键字查询时，可以用这一个字段名代替，增加查询效率，下面的copyField即用来指定复制哪些字段到keyword。注意keyword这样的字段，后面的multiValued属性必须为true。\r\n\r\nusername和email以及keyword这三个字段，用来检索查询关键字，它们的类型我们指定为text_ik，这是一个我们创造的类型，因为solr虽然内置中文分词，但效果并不好，我们需要添加IKAnalyzer中文分词引擎来查询中文。在https://github.com/EugenePig/ik-analyzer-solr5下载IKAnalyzer for solr5的源码包，然后使用Maven编译，得到一个文件IKAnalyzer-5.0.jar，把它放入solr-5.5.0/server/solr-webapp/webapp/WEB-INF/lib目录中，然后在solrconfig.xml的fieldType部分加入以下内容：\r\n\r\n    <fieldType name="text_ik" class="solr.TextField">\r\n        <analyzer type="index" useSmart="false" class="org.wltea.analyzer.lucene.IKAnalyzer"/>   \r\n        <analyzer type="query" useSmart="true" class="org.wltea.analyzer.lucene.IKAnalyzer"/>   \r\n    </fieldType>\r\n\r\n保存后，core的配置就算完成了，不过要导入mysql数据，我们还需要在mysql网站上下载mysql-connector-java-bin.jar库文件，连同solr-5.5.0/dist目录下面的solr-dataimporthandler-5.5.0.jar，solr-dataimporthandler-extras-5.5.0.jar两个文件，全部拷贝到solr-5.5.0/server/solr-webapp/webapp/WEB-INF/lib目录中，然后重启solr，就可以开始数据导入工作了。\r\n2.3 数据导入\r\n\r\n确保以上配置完全正确且solr已经运行，打开浏览器，访问http://localhost:8983/solr/#/ ，进入solr的管理页面，点击左侧Core Admin,然后Add Core：\r\n[img]http://image.3001.net/images/20160330/14593107313912.png!small[/img]\r\nname和instanceDir都填写前面我们命名的core名称solr_mysql，点击add core后，稍等片刻，core就建立完成了。此时在左边的下拉菜单选择创建的core，然后进一步选择Dataimport项，按照如下设置：\r\n[img]http://image.3001.net/images/20160330/14593107856663.png!small[/img]\r\n点击Execute，就会开始从mysql导入数据，选中Auto-Refresh Status会自动刷新进度，接下来就是漫长的等待……\r\n\r\n导入完成后，我们就可以开始查询了，solr的查询全部使用post参数，比如：\r\n\r\nhttp://localhost:8983/solr/solr_mysql/select?q=keyword:12345678&start=10&rows=100&wt=json&indent=true\r\n\r\n因为前面已经建立了复合字段keyword，所以这里我们直接用keyword:12345678会自动查找username和email中包含12345678的所有结果，start=10&rows=100指定查询结果返回第11行到第110行的内容，因为solr采用的是分页查询，wt=json指定查询结果是json格式的,还可以是xml、php、python、ruby以及csv。\r\n[img]http://image.3001.net/images/20160330/14593108273410.png!small[/img]\r\n上图返回结果中的numfound：111892代表一共返回的结果数，不指定 start和rows的情况下默认只显示前十个结果。还需要注意IKAnalyzer引擎的几个问题，在以纯数字或者纯字母关键字查询时，IKAnalyzer会返回正确的结果，但在查询数字字母混合关键字时，需要在后面加*号，查询汉字时.默认会进行分词，即把一段关键字分成几个词查询，而社工库必须精确查询，所以汉字查询必须给关键字加双引号。\r\n\r\n到这一步，如果只是搭建一个本地库，供自己使用，那么我们接下来只需写一个查询程序，post关键字，然后显示返回的结果即可，比如这样：\r\n[img]http://image.3001.net/images/20160330/14593108688746.png!small[/img]\r\n秒查，速度非常快，但如果要架设成服务器，提供给其他人使用，我们还有很多工作要做。\r\n[size=10]原文地址：[url]http://www.freebuf.com/articles/database/100423.html[/url][/size]', 0, 5, 0, '0000-00-00 00:00:00', NULL, '2016-03-31 20:23:59'),
(7, 0, '刘邦', 10, '【原创】如何用Badusb快速窃取资料', '[img]http://attach.52pojie.cn/forum/201603/31/143413y604ubqu75u54h6z.jpg[/img]\r\n[color=#f60]演示视频:[/color][url]http://v.qq.com/page/t/6/1/t0191xfj861.html[/url]\r\n0×01 引言\r\n又到了期中考试了，我又要去偷答案了，一直发现远程下载运行exe的方式不太好，容易报毒所以这里打算用ps脚本。\r\n0×02 关于HID\r\nHID是Human Interface Device的缩写，由其名称可以了解HID设备是直接与人交互的设备，例如键盘、鼠标与游戏杆等。不过HID设备并不一定要有人机接口，只要符合HID类别规范的设备都是HID设备。一般来讲针对HID的攻击主要集中在键盘鼠标上，因为只要控制了用户键盘，基本上就等于控制了用户的电脑。攻击者会把攻击隐藏在一个正常的鼠标键盘中，当用户将含有攻击向量的鼠标或键盘，插入电脑时，恶意代码会被加载并执行。\r\n0×03 准备工具 \r\n一台外网主机(直接电脑接网线宽带拨号也可以)\r\n一个HID攻击工具(烧鹅或者Badusb)\r\nFTPserver(搭建一个FTP服务器用来接收窃取到的文件)\r\nPHPstudy(搭建http服务器用来存放ps脚本等)\r\n7z.exe / 7z.dll(存放到http服务器下,之后会利用它来进行压缩后在上传，尽量减小上传速度)\r\n0×04 代码部分(以下代码可能具有攻击性,请勿用于非法用途)\r\n1.[get.bat](获取需要的文件存放位置，并保存到c:\\\\temp.bat)[该代码存放于服务器http根目录下]\r\n以下内容省略.....\r\n链接: http://pan.baidu.com/s/1hsQ2db2 密码: wikz\r\n\r\n[size=10]原文地址：[url]http://www.52pojie.cn/thread-483246-1-1.html[/url][/size]', 1, 273, 20, '2016-05-06 20:27:04', 'administrator', '2016-03-31 20:40:33'),
(42, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '[size=24]这么好的文章竟然没人评论....[/size]\r\n[size=100]这是一个漏洞哦[/size]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 13:45:07'),
(43, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', 'red;background: url(\'http://www.freebuf.com/buf/themes/freebuf/images/grey.gif\');', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:19:22'),
(44, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '[color=red;background: url(\'http://www.freebuf.com/buf/themes/freebuf/images/grey.gif\');]444[/color]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:21:07'),
(45, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '[color=red;background: url(\'http://www.freebuf.com/buf/themes/freebuf/images/grey.gif\');display:inline-block;width:9000px;height:9000px;][/color]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:22:30'),
(46, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '[size=24]漏洞终于被我堵住了，啊哈哈哈哈，我好牛逼[/size]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:47:51'),
(47, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '<script>alert(111);</script>XSS测试中', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:49:20'),
(48, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '&lt;script&gt;alert(111);&lt;/script&gt;XSS测试中!!!!!', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:50:33'),
(49, 11, 'kali', 5, 'RE:gerix wifi cracker 2发布，支持Kali和Kali 2', '&amp;lt;script&amp;gt;alert(111);&amp;lt;/script&amp;gt;XSS测试中,好像很安全了', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 18:51:33'),
(50, 11, 'kali', 5, '回复6楼的kali', '6楼就是一个逗比...', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 22:00:23'),
(51, 2, 'administrator', 3, 'RE:[Android] QQ附近的人自动打招呼名片点赞新鲜事点赞QQ空间点赞', '可是我不用小米手机哦', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-07 13:10:22'),
(52, 7, '刘邦', 10, '回复17楼的administrator', '不允许你回复了', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-07 16:11:50'),
(60, 10, 'administrator', 14, 'RE:意警方逮捕匿名者组织成员 年仅16岁', '我就是沙发~~~', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-08 10:56:09'),
(88, 13, '刘邦', 15, 'RE:成都高三女生被8所世界名校录取 会3门外语', '好丑啊！！！！', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-03 20:20:04'),
(89, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '马上就是热帖啦', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 19:21:01'),
(90, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '再来一个', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 19:21:37'),
(91, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '[size=99]最后一个咯！！！！！！！！！！！！！！！！！！！！[/size]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 19:33:48'),
(8, 0, '刘邦', 9, '一次很特别的验证码识别', '一次很特别的验证码识别\r\n\r\n简单验证码识别的步骤一般是去噪->切割->对比识别，一般来说这种工作特别费时间，所以遇到一些特别的站的时候就要多想想其他方式了。\r\n\r\n最近想做一个APP，把学校的教务，一卡通，流量查询等各种系统集中在一起，但是遇到了一个严重的问题：门户系统的验证码。\r\n\r\n教务，一卡通，流量都是需要通过门户进入的，当然我也可以选择将验证码返回到客户端让用户自己识别，然而我还是想尝试一下的。\r\n\r\n验证码是如下的图片：\r\n[img]https://forum.90sec.org/forum.php?mod=attachment&aid=MTkzODV8ZDhkY2ZmMTh8MTQ1OTQyODUxMHwyNDE5fDkzMTE%3D&noupdate=yes[/img]\r\n这种验证码中间用了个扭曲的算法，将一部分图像扭曲了，如果直接识别，1和7的位置的不同会导致切割和识别出错，粗略计算了一下，如果按照这种方法，最终的识别率在百分之20左右，只能另寻生路。\r\n\r\n其实，仔细看一下，这种验证码没有任何的随机噪点，然后对比一下第一排第二个验证码和第二排第二个验证码的最后一位数，两个“8”完全一模一样。\r\n\r\n所以就可以考虑一下做个kv(key-value)映射表了。\r\n\r\n经过大量的尝试，发现这些验证码里面只有1-9，所以一共有6561个验证码图片，而相同的验证码的图片也是一模一样的，所以这个kv映射表的key就是验证码图片的md5值，value就是验证码。\r\n\r\n1、先来建立一个kv数据库，把所有的图片down下来，代码：\r\n\r\n#!/usr/bin python\r\n \r\n#coding: utf-8\r\n \r\nimport requests\r\n \r\nimport MySQLdb\r\n \r\nimport md5\r\n \r\nconn=MySQLdb.connect(host=\'localhost\',user=\'root\',passwd=\'\',port=3306)\r\n \r\ncount = 9000\r\n \r\nwhile count <= 50000:\r\n \r\n   print count\r\n \r\n   content = requests.get(\'图片地址.jpg\').content\r\n \r\n    m = md5.new()\r\n \r\n   m.update(content)\r\n \r\n    m = m.hexdigest()\r\n \r\n   cur=conn.cursor()\r\n \r\n   print m\r\n \r\n   res = cur.execute("select md5 from md5.tables where md5=\'%s\'"%m)\r\n \r\n   print res\r\n \r\n   if res == 0:\r\n \r\n       cur.execute("insert into md5.tables(num, md5) values(\'%d\',\'%s\')" % (count, m))\r\n \r\n       conn.commit()\r\n \r\n       f = open(\'./data_2/\' + str(count) + \'.jpg\', \'wb\')\r\n \r\n       f.write(content)\r\n \r\n       f.close()\r\n \r\n   count += 1\r\n \r\n   cur.close()\r\n \r\nconn.close()\r\n \r\n</code>\r\n\r\n\r\n2、然后就是需要识别6000多个图片，自己识别是很浪费时间的，所以我选择了一个打码平台，我使用的是云速：www点ysdm点net，6600个图片，当时他并没有开发文档，只有测试接口，要想识别，就只能从测试接口通过一个html-upload接口上传图片上去，这是代码，中间有用户名和密码等：\r\n\r\n[Python] 纯文本查看 复制代码\r\n#coding: utf-8\r\n \r\nimport requests\r\n \r\nimport re\r\n \r\nimport MySQLdb\r\n \r\nconn=MySQLdb.connect(host=\'localhost\',user=\'root\',passwd=\'\',port=3306)\r\n \r\nfor num in range(5222,6000):#0,6508\r\n \r\n   cur=conn.cursor()\r\n \r\n   try:\r\n \r\n       cur.execute("select num from md5.tables order by num limit %d,1" %num)\r\n \r\n       n = cur.fetchall()[0][0]\r\n \r\n       print n,num\r\n \r\n       files={\'username\':(None,\'\'),\r\n \r\n           \'password\':(None,\'\'),\r\n \r\n           \'softid\':(None,\'1\'),\r\n \r\n           \'timeout\':(None,\'60\'),\r\n \r\n           \'softkey\':(None,\'\'),\r\n \r\n           \'typeid\':(None,\'5000\'),\r\n \r\n           \'image\':(\'%s.jpg\'%n,open(r\'E:\\tmp\\data_2\\%s.jpg\'%n,\'rb\').read(),\'image/jpeg\')\r\n \r\n        }\r\n \r\n       headers = {\'Cookie\':\'_\': \'zh-CN,zh;q=0.8\', \'Accept-Encoding\': \'gzip,deflate\', \'Referer\': \'http://www.ysdm.net/home/OnTest\', \'DNT\': \'1\',\'User-Agent\': \'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36 SE 2.X MetaSr 1.0\', \'Origin\': \'http://www.ysdm.net\',\'Accept\': \'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\',\'Cache-Control\': \'max-age=0\'}\r\n \r\n       a = requests.post("http://www.ysdm.net/home/OnTest",files=files,headers=headers)\r\n \r\n       code = re.search(\':([1-9]{4})"\',a.content).group(1)\r\n \r\n   except Exception,e:\r\n \r\n       print e\r\n \r\n       code = \'0000\'\r\n \r\n   print code\r\n \r\n   cur.execute(\'update md5.tables set val=%s where num=%s\' %(code, n))\r\n \r\n   cur.close()\r\n \r\n   conn.commit()\r\n \r\nconn.close()\r\n \r\n</code>\r\n\r\n\r\n3、等了一天以后，百分之80的验证码就down下来了，不用过多，百分之80的识别率就OK了，因为不论怎样，百分之百的识别是不可能实现的。\r\n这是最后的效果：\r\n[img]https://forum.90sec.org/forum.php?mod=attachment&aid=MTkzODN8OWMzYTkwYWJ8MTQ1OTQyODUxMHwyNDE5fDkzMTE%3D&noupdate=yes[/img]\r\n现在就是最后一步了，写个php来实现在线识别：\r\n\r\n[PHP] 纯文本查看 复制代码\r\n<?php\r\n$mysqli = new mysqli(\'localhost\',\'root\',\'\',\'md5\');\r\n \r\nif (mysqli_connect_errno()){\r\n \r\ndie(\'Unable to connect!\'). mysqli_connect_error();\r\n \r\n}\r\n \r\n$mysqli->query("SET NAMES utf8");\r\n \r\n$md5 = $_GET[\'md5\'];\r\n \r\n$md5_white = \'\';\r\n \r\nif(!preg_match(\'([0-9a-f]{32})\',$md5,$md5_white)) die("fuck");\r\n \r\n$sql = "select val from tables where md5=\'$md5_white[0]\'";\r\n \r\n$query = $mysqli->query($sql);\r\n \r\nwhile($rs=$query->fetch_array())\r\n \r\n{\r\n \r\n   if(!empty($rs[\'val\'])) echo $rs[\'val\'];\r\n \r\n   else {\r\n \r\n   echo "0";\r\n \r\n    }\r\n \r\n}\r\n \r\n?></code>\r\n\r\n\r\n这中间用了一些处理，只允许32位的md5传入，否则输出fu**。\r\n\r\n最后访问http://localhost/md5.php?md5=xxxxx就可以返回验证码值了，客户端只需要将图片的md5值传过来就可以获取到验证码值。\r\n[img]<script>alert(11)</script>[/img]\r\n[size=10]原文地址：[url]https://forum.90sec.org[/url][/size]', 0, 127, 0, '2016-04-07 16:25:48', NULL, '2016-03-31 20:51:03'),
(9, 0, '张华', 8, '腾讯安全sniper战队成为史上首个“世界破解大师”', '黑客“世界杯”走了，黑客世界总冠军来了！北京时间3月18日上午，首个Pwn2Own世界总冠军诞生！腾讯安全Sniper战队凭借总积分38分名列Pwn2Own积分榜榜首，摘得世界总冠军，并且获得这一顶级赛事史上首个“Master of Pwn”（世界破解大师）称号。这不仅是Pwn2Own史上第一个世界总冠军，也是中国黑客团队首次登上世界之巅！\r\n[img]http://shp.qpic.cn/txdiscuz_pic/0/_bbs_guanjia_qq_com_forum_201603_18_102828aqe04424ez84v48q.jpg/0[/img]\r\nPwn2Own第二日，腾讯安全Sniper战队首战攻破苹果safari浏览器并获得ROOT权限，得到全额积分10分。此次针对Apple Graphic，腾讯安全战队攻破方法被认定为安全研究领域新的利用方法；在极具挑战难度的微软Edge浏览器上，速度攻破并获得SYSTEM权限，取得全额积分15分，累计积分25分。加上首日累计积分13分，此次腾讯安全Sniper战队通过3场比赛共获得38分满分锁定“Master of Pwn”（世界破解大师）称号。此外，本届比赛腾讯安全战队总计拿到48分，遥遥领先其他参赛团队。\r\n[img]http://shp.qpic.cn/txdiscuz_pic/0/_bbs_guanjia_qq_com_forum_201603_18_102830toj2a3si22zyozay.jpg/0[/img]\r\n在Pwn2Own两天11场比赛中，腾讯安全Sniper战队向苹果safari浏览器、Adobe Flash插件、微软Edge浏览器项目发起挑战，3个项目100%完成。根据Pwn2Own2016公布的新规则判断，此次参赛项目的选择，基于腾讯安全战队对Pwn2Own战略上的部署。\r\n　　按照Pwn2Own旧则，参赛团队在赛前会进行抽签，幸运的参赛团队（个人）能够获得全额奖金，而同样报名该项目的后来攻破者只能获得一半的奖金。今年，Pwn2Own设立“Master of Pwn”（世界破解大师）称号，引入积分制，并规定参赛总积分最高的团队（个人）将成为Pwn2Own史上第一个世界总冠军。而从腾讯安全战队抽签失利的境况来看，此布局也体现了其对世界总冠军势在必得的信心！\r\n　　至今已十年的Pwn2Own，作为全球最高规格的黑客大赛，以高难度与高奖金额吸引全球顶级黑客的目光。而在这个世界黑客顶级荣誉殿堂上，腾讯安全战队并非首次亮相。\r\n　　此次代表中国出征Pwn2Own的腾讯安全战队的Sniper战队由科恩实验室研究员与电脑管家团队成员组成，阵容勘称豪华。科恩实验室作为腾讯安全新成立的一支专注于云计算与移动终端安全研究的白帽黑客队伍，此次派出其核心成员陈良、Peter等出战，他们是亚洲最早参加Pwn2Own并夺冠的世界超一流黑客；腾讯电脑管家团队成员毛军去年首次亮相Pwn2Own便大放异彩，攻破IE浏览器PDF插件夺得冠军。\r\n　　腾讯安全战队在Pwn2Own赛事上成绩，证明了腾讯安全团队的研究水平得到了世界的认可，说明其安全输出能力与苹果、微软、谷歌等科技巨头形成了对等的攻防对抗，不仅在国内处于领先地位，也迈入了世界级行列。\r\n转载自腾讯电脑管家论坛\r\n[size=10]原文地址：[url]https://forum.90sec.org/forum.php?mod=viewthread&tid=9278[/url][/size]', 0, 130, 0, '0000-00-00 00:00:00', NULL, '2016-03-31 20:57:46'),
(10, 0, '张华', 14, '意警方逮捕匿名者组织成员 年仅16岁', '意大利警方宣布在意大利东北部城市乌迪内(Udine)逮捕了一名16岁少年黑客，其涉嫌参与并领导匿名者成员发动了名为#OpSafePharma的网络攻击活动。警方并未透露这么黑客的姓名，但黑客社区指出他正是网名为Artek匿名者组织成员。\r\n[img]http://www.evil0x.com/wp-content/uploads/2016/03/f033fcc2127e606131a0.png[/img]\r\n#OpSafePharma是一系列针对意大利医疗卫生系统发动的网络攻击活动，从3月16日期使用DDoS攻击手段对意大利卫生部、高等卫生研究所医疗，和数个当地卫生健康机关进行了攻击，据意大利邮政、警察、通讯通信办公室称。从攻击一开始（CNAIPIC）意大利国家反网络犯罪中心的服务器就开始追踪到Artek的活动，并最终掌握了充分的证据确认并实行了逮捕\r\n[size=10]原文地址：[url]http://www.evil0x.com/posts/18187.html[/url][/size]', 0, 253, 1, '0000-00-00 00:00:00', NULL, '2016-03-31 21:01:31'),
(11, 0, '张华', 5, 'gerix wifi cracker 2发布，支持Kali和Kali 2', 'gerix wifi cracker是我最喜欢的BT5上的无线渗透工具，由于Kali使用了QT4并且airmon-ng也升级新版本，原来的版本停止了更新，导致无法使用，我趁有空改了一下，现在支持在Kali和Kali 2上运行，并且修复了一些影响正常工作的小问题。\n[img]https://www.nigesb.com/wp-content/uploads/2015/10/gerix-wifi-cracker-2.png[/img]\n使用方法：\n?\ngit clone https://github.com/J4r3tt/gerix-wifi-cracker-2.git\ncd gerix-wifi-cracker-2\npython gerix.py\n\n项目地址：\nhttps://github.com/J4r3tt/gerix-wifi-cracker-2\n[size=10]原文地址：[url]https://www.nigesb.com/gerix-wifi-cracker-2-realease.html[/url][/size]', 1, 266, 9, '0000-00-00 00:00:00', NULL, '2016-03-31 21:04:26'),
(12, 0, '张华', 15, '360天眼实验室安全招聘', '[img]http://image.3001.net/images/20160330/14593399964887.png!small[/img]\n360天眼实验室(SkyEye Labs)正式成立于 2014 年 1 月,是 360 公司旗下专门利用大数据技术研究未知威胁的技 术团队。该实验室依托 360 公司多年来积累的海量多维度安全大数据和数据 挖掘技术,实现对全网未知威胁的发现、溯源、监测和预警,及时准确地为 客户提供安全检测和防护设备所需要的威胁情报。\n0×00 引子\n\n人在做，天在看。天眼搜寻志同道合的小伙伴，欢迎更多伙伴加入团队。\n\n    \n0×01 职位清单\n数据挖掘工程师   25K起\n\n 职位描述：\n\n    1、分析网络日志、文本和图像数据，利用数据挖掘算法构建模型，解决网络安全相关问题。\n\n    2、运用图论数理统计知识对大规模网络数据进行挖掘和分析。\n\n    3、参与大数据平台的开发和优化。\n\n职位要求：\n\n    1、以下三者至少具备其一：\n\n    （1）精通数据挖掘和机器学习常用算法，如：决策树、随机森林、SVM、神经网络、聚类等。对特征抽取和特征选择有研究。\n\n    （2）有图像处理、人脸识别、深度学习或强化学习的研究和实践经验，有实际成果\n\n    （3）具备扎实的数理统计功底，能够熟练统计各种变量、并对结果进行合理解释、分析相关性等。\n\n    2、计算机、统计、数学相关专业，善于发现数据规律，能够将特定的业务需求转化为数学模型。\n\n    3、熟悉Linux系统和Shell编程，熟悉数据库，具备python开发经验。\n\n 优先条件：\n\n    1、有大规模分布式计算（Hadoop、HBase）经验者优先。\n\n    2、在深度学习或强化学习方面有高水平论文或实际产品研发经验者优先。\n\n前端与可视化工程师   20K起   \n\n职位描述：\n\n    天眼产品前端，可视化方向\n\n    与设计师、产品工程师紧密工作在一起，实现产品UI和交互方面的开发需求。\n\n    确保产品具有优质的用户体验与良好的兼容性。\n\n职位要求：\n\n    1.熟练使用 HTML、CSS 进行页面构建和布局，对 HTML5、CSS3 有实践经验\n\n    2.熟练 JavaScript，对其语言特性有深入认识\n\n    3.熟悉 AMD / CMD / CommonJS 等模块化开发机制及一些常用的设计模式\n\n    4.熟悉 jQuery / Underscore 等常用类库\n\n    5.熟悉 Backbone / Angular / React / Vue 等前端开发框架\n\n    6.对 Web 开发具有全局观，了解浏览器基本原理和服务器端的开发方式\n\n    7.能编写风格良好的代码，对前端性能优化有一定了解\n\n    8.喜欢捣腾前沿技术，并对行业趋势有高度敏感性\n\n    优先条件：\n\n    可视化方向的，熟练svg，canvas；熟悉d3.js，createjs(easejs，tweenjs)；具有WebGL或者unity开发经验者优先\n\n安全规则工程师   20K起\n\n 职位描述：\n\n    1、安全漏洞的分析和重现，包括二进制类方向及web方向。\n\n    2、漏洞利用代码及工具的分析，特征提取及验证。\n\n 职位要求：\n\n     1、了解各类网络漏洞的成因，web漏洞及二进制漏洞两个方向中熟悉其中之一，二进制漏洞方向要求可熟练使用OD等调试器重现漏洞。\n\n    2、设计匹配目标恶意代码的有效规则(网络数据流及文件级别特征)，并持续测试改进。\n\n    3、具备Python或其他脚本语言的开发经验。\n\n 优先条件：\n\n1、熟悉office/flash/pdf漏洞，有相关分析经验优先。\n安全漏洞分析工程师    20K起\n\n 职位描述：\n\n    1、安全漏洞的分析和重现，二进制类方向。\n\n    2、漏洞利用代码及工具的分析，特征提取及验证。\n\n    3、漏洞分析相关动静态工具的使用和改进。\n\n 职位要求：\n\n    1、深入理解客户端类安全漏洞的成因，熟练使用OD等调试器，对混淆对抗经验，精通调试分析重现。主要涉及客户端应用程序：Office、Java、Flash、Adobe Reader等。\n\n    2、熟练使用Yara等规则引擎，设计匹配目标恶意代码的有效规则，并持续测试改进。\n\n    3、具备Python或其他脚本语言的开发经验，能够对样本做自动化检测和数据提取。\n\n 优先条件：\n\n    1、有Linux平台的恶意代码分析经验优先。\n\n    2、有手机相关漏洞或恶意代码分析经验优先。\n\n威胁情报研究员   15K起\n\n 职位描述:\n\n    1、能主动关注国内外最新安全攻防技术，并在自己擅长和兴趣的领域能够进行深入的学习、研究\n\n    2、收集研究威胁情报，支撑360威胁情报中心日常运营体系\n\n    3. 熟练掌握目前包括Windows、linux、移动终端上的主流的攻防手段、技术、工具等 \n\n    4 .对Web安全、服务端安全、客户端安全、移动安全、无线安全、物联网安全等有深入了解和研究\n\n    5.具备至少一门语言熟练编程能力\n\n    6.具备英语读写能力，能熟练阅读英文技术文档，较好的文档撰写能力。\n\n    7.具备良好的团队沟通、协作能力、良好的职业道德\n\n优先条件：\n\n    1.发布过原创技术研究、分析文章的\n\n    2.曾经或正在开发安全相关工具的\n\n    3.具备多年安全相关从业经验的\n\n    4.能够独立完成综合入侵渗透测试的\n\n    5.能够独立挖掘Web、PC客户端、移动客户端漏洞的\n\n    6.具备创新精神、能主动研究和发掘新的攻击方式的\n\n    7 有威胁情报相关经验\n\n服务端底层开发工程师   20K起\n\n 职位描述：\n\n从事linux服务端软件开发，网络安全相关产品开发。\n\n职位要求：\n\n    扎实的linux系统知识，及TCP/IP网络协议栈知识。 \n\n    规范严谨的C/C++代码编写及调试能力。 \n\n    熟练使用shell/python等脚本开发的能力。 \n\n    熟悉主流数据库使用及redis，zeromq等开源工具。 \n\n    熟练使用相关工具进行网络报文协议理解分析的能力。\n\n 优先条件：    \n\n    对高性能，高稳定性，高并发场景的系统有调试经验。 \n\n    熟悉linux内核，熟悉驱动模块开发，有硬件板卡调试经验。 \n\n    从事过网络安全相关工作，比如开发过firewall/ids/ips/scanner等产品。 \n\n    熟悉常见的网络攻击及防御技术，对安全有浓厚兴趣。 \n\nPython开发工程师   20K起\n\n 职位描述：\n\n    1、开发和维护平台系统；\n\n    2、配合团队其他成员进行模块开发及整合；\n\n    3、与大数据技术人员配合，将相关分析方法，进行技术实现；\n\n    4、新技术研究和应用，并推动适合的技术应用于生产；对现有系统提出优化建议并实施；\n\n 职位要求：\n\n    1、熟悉Python（或熟悉PHP、Java等Web语言并有志于从事Python开发）及Flask、Tornado、Django 等框架；\n\n    2、熟悉Mysql、Postgresql等关系型数据库设计和优化，熟悉Redis、Ssdb等Nosql数据库使用；\n\n    3、熟悉Nginx、Apache等Web服务器使用和优化；\n\n    4、熟练使用Linux常用命令，熟悉HTTP、TCP/IP等协议；\n\n    5、熟练使用Git工具，具有良好的编码和文档编写习惯，具有良好的学习能力、沟通能力和责任心；\n\n    6、计算机相关专业，本科及以上学历；\n\n 优先条件：\n\n    1、熟悉网络安全知识、了解常见网络攻防措施者优先；\n\n    2、了解elasticsearch技术者优先；\n\n    3、对多线程、多进程、系统IO程序优化有相关经验者优先；\n\n    4、具有hadoop、hbase、spark、storm使用经验者优先；\n\n    5、有资产管理平台、自动构建及部署系统、配置管理系统、监控报表经验者优先。\n\n感兴趣小伙伴请发简历至  dangying@360.cn、zhangzhuo@360.cn\n[size=10]原文地址：[url]http://www.freebuf.com/jobs/100477.html[/url][/size]', 0, 43, 0, '0000-00-00 00:00:00', NULL, '2016-03-31 21:08:00'),
(13, 0, '张华', 15, '成都高三女生被8所世界名校录取 会3门外语', '[img]http://photocdn.sohu.com/20160331/Img442892655.jpg[/img]\r\n华西都市报#成都身边事#【厉害！成都高三女生被8所世界名校录取】又一学霸！截至30日，成都外国语学校高三生文艺霖已收到哥伦比亚大学、巴黎政治学院、波莫纳学院等8所世界名校的录取通知书。文艺霖会三门外语，还是个球迷，洛杉机银河足球俱乐部到国内访问时，她还担任英语翻译。记者 张铮\r\n(责任编辑：刘盛钱 UN649) \r\n[size=10]原文地址：[url]http://news.sohu.com/20160331/n442892654.shtml[/url][/size]', 0, 31, 1, '0000-00-00 00:00:00', NULL, '2016-03-31 21:11:15'),
(14, 0, '张华', 8, '哪位开国将领获赠“免死金牌”？ 曾降职8次', '[提要]　　 1955年9月，授衔时王耀南只是一名少将，但他获得二级八一勋章、一级独立自由勋章、一级解放勋章。特别是他在红军时期获得可终身免除死刑的二等红星奖章（中华苏维埃共和国政府规定终身免除死刑，相当于古代的免死金牌，现存军事博物馆）和红旗奖章，是他人难以相比的，是对他的最高奖赏和最高评价，也是对工兵（现工程兵）的最高肯定。\r\n　　幼年立志求真理\r\n　　江西萍乡上栗村，从古至今赫赫有名，因为这个村庄的不足百十户人家世世代代以生产鞭炮为生。1911年冬月，王耀南降生于这个村庄的一个鞭炮世家，起名为冬伢子，小伙伴们都叫他南伢子。他聪明好学，5岁就开始跟着叔父们学习制作鞭炮，几年下来，就掌握了数十种烟花爆竹的配方，技术也很纯熟，在同龄人中甚有出息。1919年，上栗村在制造鞭炮时候不慎引爆炸药，半个村子被夷为平地。王耀南和妹妹随着母亲，一路讨饭走到安源投靠父辈。\r\n　　当时，安源有个萍乡煤矿，是1889年中国官僚买办资产阶级创建的。王耀南的父辈们在矿井下当放炮工，用繁重的劳动换取微薄的薪饷糊口。帝国主义和官僚相互勾结，对工人进行残酷的剥削和压迫，把安源变成了人间地狱。安源成为中国共产党领导工人运动的策源地，是湘赣边秋收起义的主要爆发地之一，也是中共湖南省委指挥暴动的军事中心。\r\n　　王耀南到了安源后开始跟随其父学习放炮，小小年纪担负着超乎寻常的劳动任务。1921年秋，中共成立不久，湖南支书毛泽东把发展工人运动作为工作重点，到安源煤矿考察。他在井下与工人们促膝谈心。王耀南第一次见“穿衣服”（矿井下的工人只有三尺汗布，井下包头巾，井上遮羞布和回家洗澡布。没人穿着衣服下井）的教书先生到井下，非常稀罕，于是坐在毛泽东身边，聆听教诲。毛泽东在井下给工人们传播革命道理，深入浅出的道理在王耀南幼小的心里点燃了革命的火种。1922年，李立三创办了第一所路况工人补习学校，在教学中把科学文化与工人的日常生活结合起来，后来又秘密进行马克思主义启蒙教育，王耀南幼小的心灵受到了强烈的震撼。\r\n　　1922年4月，安源煤矿和株萍铁路工人举行盛大的集会和游行以纪念国际劳动节。王耀南带领小伙伴们在矿井下以拉电闸、整监工、破坏一些劳动工具设施，响应活动。于是中共将这些苦大仇深的矿工儿童组织起来成立了安源儿童团。儿童团员们秘密从事着当时成年人难以完成的任务。王耀南首当其冲。当时，为了避开工头的追踪，工人们有时要在矿井下开会，儿童团员们就在门口放哨。一次，工头悄悄地到矿井下检查，王耀南机警地迎上去，大声喊道：“大叔，你来啦！”工头骂道：“你喊什么喊？”说着抡起皮鞭就要打人。“你为啥打人啊？”喊声更大了。开会的人听到了王耀南发出的信号就立刻散开。在儿童团期间，王耀南和小伙伴们成功地完成了多项任务。1922年安源大罢工开始，11岁的王耀南走在罢工队伍的最前列，带领17000多名工人高喊着惊天动地的口号“从前是牛马，现在要做人”。他还带领着儿童团贴标语、糊旗子、撒传单、高唱《劳动歌》，悲壮的歌声响彻天空，歌词字字铿锵有力。刘少奇同志曾经多次说：“我在安源领导大罢工取得胜利，全是依靠像王耀南这样的产业工人”。罢工在党的领导下，在全国的支持下取得了胜利，少年的王耀南也经受了斗争风雨的洗礼。\r\n　　金戈铁马驾狂飙\r\n　　王耀南的一生就是一部中国工兵史，因此同志们称他为工兵王。他精通爆破、架桥，曾被同志们亲切地称为红军架桥王、坑道爆破王、工程构筑王、地雷战王。纵观王耀南的成长和战争史，这些称号的确名副其实。\r\n　　1930年，王耀南加入中国共产党。不久，就接到了筹建工兵连的命令。朱德亲自向王耀南交代组建工兵连的任务，王耀南任工兵连连长。成立工兵连时，朱德说：“工兵很重要，一千年以前就有了。工兵逢山开路，遇水架桥，这个任务很光荣，也很艰巨。”\r\n　　7月，王耀南率队赶往江西南昌。工兵报到后，彭德怀亲自督阵在浏阳河上架通浮桥。红三军团在长沙附近七里巷、乌梅岭受阻，彭德怀命红八军顺浏阳河下杉木港迂回到敌人后部。工兵连被加强给红八军。王耀南向军长何长工请命任敢死队队长，率船头架有机枪的几条船利用机枪火力和土手榴弹冲破了敌人河防，红八军绕到敌人背后击退了敌人。工兵队利用红八军乘坐的船只奉彭德怀命令在东渡屯架设浮桥。当晚王耀南指挥敢死队炸开了长沙城门，午夜红三军团便占领长沙。战后，省委特派员却以王耀南未带领3000工兵参战为由，将他降职为伙夫班长，而政委杨明因为王耀南被降为连指导员。\r\n　　8月，工兵团奉命再次攻打长沙，王耀南再次被任命为连长。此时工兵队仅剩下一个连队。红一方面军参谋长命令王耀南率工兵炸开长沙浏阳城门外铁丝网和鹿寨。但是他们不知道铁丝网上有高压电，指导员杨明触电身亡，其他战士为了抢救指导员全部牺牲。王耀南仔细研究爆破电网方法，排除爆破组炸开电网，红军屡攻长沙不克，退出战斗。王耀南身负重伤，在小河村修养。但是他的伤还未痊愈，就奉命率队于11月2日前在罗坊架通浮桥，接应红三军团南渡袁水。经勘查，王耀南认为短时间内修补严重腐朽的木码头太困难，提出了修石码头的建议，他带领工兵奋战两昼夜，建成了石码头，架通了浮桥。\r\n　　此后王耀南参加了5次反围剿，第3次反围剿结束后，王耀南于1932年1月率工兵连参加赣州战役。根据陈毅的指示，王耀南负责指挥工兵连挖掘10余条坑道。第1次坑道爆破时，因观察爆破效果后才发起进攻而贻误了战机；第2次爆破时，红二师不肯将部队撤出危险区，担心再次贻误战机。红五团团长叶长庚命令敢死队向城墙前运动，王耀南向三军团首长解释不能这么做，但是总部命令：工兵必须按时起爆，否则以违反战场纪律论处。第一炸点起爆，敢死队员全部牺牲。第二炸点起爆，为工兵担任掩护的莫文骅连队阵亡70%。王耀南奉命组织挖掘坑道，敌方工兵利用坑道与我工兵对抗。敌主力一部利用坑道从赣州城里出击，袭击红一指挥部，俘虏师长侯忠英。红一师腹部受敌，仓促撤出阵地。但是未及时通知在坑道中作业的工兵。王耀南等在坑道里死守，坚决不做俘虏，直到红十五军组织反击，将敌人赶进赣州城，才将坑道中负伤的王耀南等救出。此次战役中，王耀南深深地体会到，工兵在坑道作业时必须携带武器，坑道光能防不能打是不行的。坑道内必须挖掘战斗交通道，以防不测。王耀南就是这样在战争中学习战争。\r\n[size=10]原文地址：[url]http://history.sohu.com/20160128/n436023037.shtml[/url][/size]', 0, 48, 1, '2016-04-06 13:41:39', NULL, '2016-03-31 21:12:30'),
(15, 0, '李鑫', 2, '习近平前往美国出席第四届核安全峰会', '[movie]http://tv.sohu.com/20160331/n442924028.shtml[/movie]\r\n新华社布拉格3月30日电国家主席习近平30日圆满结束对捷克为期三天的国事访问，乘专机离开布拉格前往美国首都华盛顿，出席在那里举行的第四届核安全峰会。\r\n\r\n　　习近平主席当地时间28日下午抵达布拉格。在对捷克进行国事访问期间，习近平主席同泽曼总统举行会谈，同参议院主席什捷赫、众议院主席哈马切克、总理索博特卡等捷方领导人举行会见。双方就中捷关系、中欧关系、中国－中东欧国家合作及共同关心的国际和地区问题深入交换意见，达成广泛共识。\r\n\r\n　　习近平主席和泽曼总统一致同意，将中捷关系提升为战略伙伴关系，推动中捷关系再上新台阶。习近平主席访问期间，双方签署了《中华人民共和国和捷克共和国关于建立战略伙伴关系的联合声明》以及电子商务、投资、科技、旅游、文化、航空等领域合作文件。\r\n\r\n　　启程前往华盛顿前，习近平主席30日上午与泽曼总统共同出席中捷经贸合作圆桌会。随后，泽曼总统陪同习近平主席参观斯特拉霍夫图书馆，两国元首亲切话别。\r\n\r\n　　在结束对捷克国事访问后，习近平主席将出席3月31日至4月1日在美国华盛顿举行的第四届核安全峰会。习近平主席将在全会上作主旨发言，全面阐述中国政策主张，介绍中国在核安全领域的新举措和新成就，并提出加强全球核安全的实质倡议。\r\n\r\n　　出席峰会期间，习近平主席同美国总统奥巴马将举行会晤。这将是两国元首今年首次会晤，对推动两国关系继续稳定向前发展具有重要意义。习近平主席还将同有关国家领导人举行多场双边会见，就双边关系和共同关心的国际和地区问题等交换看法。\r\n[size=10]原文地址：[url]http://news.sohu.com/20160330/n442885107.shtml[/url][/size]', 0, 34, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 12:32:16'),
(16, 0, '李鑫', 12, '评论：李克强对中国经济的信心从哪里来？ *', '摘要：政府并没有因为这些出现的问题改变市场化、法制化的改革方向\r\n　　2016是中国的“经济年”。中国经济增速放缓的压力，也表现在李克强总理在“两会”后的记者答问中。可以看到，记者会起初的几个问题基本全都是跟经济有关的，而总理的回答中，也体现出政府对这些问题的清醒认识和解决问题的决心与信心。\r\n我喜欢**我日\r\n　　中国的股市和汇市在去年发生了较大幅度的波动，受到全世界的瞩目，对于中国发生金融动荡的各种“唱衰”之声也随之出炉。对外界对于中国金融体系的质疑，李总理的回答是：第一，再次明确金融为实体经济服务的方针，表现出对金融“脱实向虚”的警惕。以美国为首的一些国家，在经济发展中金融产业过度膨胀，事实上“绑架”了实体经济，最终金融泡沫破灭，造成经济危机全面爆发。殷鉴不远，作为以制造业为主体的发展中经济体，中国决不能走上这条“邪路”，对此，中央是很清楚的。\r\n　　第二，以“债转股”等方式解决高债务问题。近期中国企业债过高的问题引发忧虑，国际评级机构穆迪因此下调了中国的债务评级展望。对此，李总理一方面解释，企业债务率高是老问题，主要原因是中国股市等直接融资渠道不足，企业多采取的是向银行贷款等间接融资的方式，相比资本市场发达的国家，企业债务的比例显得就高了。不过，由于中国居民储蓄率高，银行存款存量大，企业债的高企还不至于直接对金融机构造成过大冲击。同时，总理也提出将采取“债转股”的方式，帮助企业更多在资本市场上筹集资金，降低债务所占比例。\r\n\r\n　　第三，完善对金融市场的监管。去年发生股市异常波动，中央从防范系统性风险的角度采取了断然措施，避免了金融系统的一场危机，从中也发现了中国金融监管体系存在的一些不足。2016年，完善监管将是政策的重点方向。具体的要求有：监管实现对金融产品的“全覆盖”、增强部门之间的政策协调性、中央和地方分层负责等。对此，总理话说的很重，如果做不好“拿你是问”，这也是对相关部门和地方做出了严格的履职要求，下了“军令状”。\r\n\r\n　　对于中国经济能否达成6.5%的GDP目标，外界也有着一定的质疑。总理的回答中，主要强调了几点，一是中国经济中传统产业困难和新兴产业“火爆”的现象并存，希望大于困难；二是人民群众具有强大的创新潜力，政府需要少管“不该管的事”，同时加强应有的监管，就能激发市场的活力和人民的创造力；三是如果经济增长滑出合理区间，中国政府还有宏观调控的政策储备，可以稳定经济运行。\r\n\r\n　　综观总理记者会的问答，显然政府对于中国经济所面临的一些风险有着清醒的认识，对金融“脱实向虚”、债务过高等问题也保持了高度的警惕，并提出了相应的对策方针，避免这些风险失控。不过，政府并没有因为这些出现的问题改变市场化、法制化的改革方向，相反，要将这些危机转化为进一步改革的契机，推动“债转股”、简政减税、结构调整等改革措施，以改革促发展，实现中国经济的“浴火重生”。\r\n\r\n　　信心之所以不同于盲信，在于它是建立在对形势的把握和对未来的规划之上的。正是有着对困难的清醒认识和对“改革路线图”的清晰规划，李克强总理才会展露出充分的信心，表示中国经济能实现“十三五”良好开局，为世界带来一阵“暖风”。对此，我们充满期待。（文/王少喆）\r\n[size=10]原文地址：[url]http://star.news.sohu.com/20160318/n440917829.shtml[/url][/size]', 0, 618, 5, '2016-05-06 23:41:31', 'administrator', '2016-04-06 12:33:06'),
(17, 7, 'study-php', 10, 'RE:【原创】如何用Badusb快速窃取资料', '我来顶顶！！！', 0, 3, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:24:15'),
(18, 7, 'study-php', 10, 'RE:【原创】如何用Badusb快速窃取资料', '这是我第[b][size=24]二[/size][/b]次回你的帖子了哦', 0, 3, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:25:46'),
(19, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', '这个技术好高级，可是我买不起设备', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:45:59'),
(20, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', 'ceshizzzzzzz[u]aaaaaaaaaaaa[/u][b]dweqweqw[/b]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:46:39'),
(21, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', '`````````````````````````````````````````````````````````````\r\ndasd\r\nsad\r\nsa\r\nas\r\nd\r\nas\r\nd\r\nas\r\ndas', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:47:01'),
(22, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', '\'\'\'\'\'\'\'"""""<script>alert(111)</script>\'\'\'', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:47:44'),
(23, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', 'aaaaaaaadasd雯雯为单位打萨达萨达爱的', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:48:11'),
(24, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', '77809000[size=24]这水利局无回复就无法[/size]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:48:40'),
(25, 7, '韩信', 10, 'RE:【原创】如何用Badusb快速窃取资料', '[u]1111111111111111111111111111111111111111[/u][s]sssssssss真无力\r\n[/s]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:49:08'),
(26, 7, '罗灿', 10, 'RE:【原创】如何用Badusb快速窃取资料', '[i]听说这个帖子很火[/i]\r\n我也来看看', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 12:50:36'),
(30, 7, '罗灿', 10, 'RE:RE:【原创】如何用Badusb快速窃取资料', '[s]及购房款；的打开；； 了；‘’ ； 地方 \r\n\r\n\r\n[/s]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 13:44:26'),
(31, 7, 'administrator', 10, 'RE:RE:RE:【原创】如何用Badusb快速窃取资料', '[color=#930]回复一个试试看[/color]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 16:16:22'),
(32, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '这次没有很多RE了', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 16:46:37'),
(33, 1, 'administrator', 6, 'RE:my frist article', '我还是不是沙发', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 17:16:50'),
(34, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '第一个被统计的评论哦', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 17:58:55'),
(35, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '第一个被统计的评论哦', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 17:59:19'),
(36, 16, 'administrator', 12, 'RE:评论：李克强对中国经济的信心从哪里来？', '我来回复一个', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 18:02:37'),
(37, 16, 'administrator', 12, 'RE:评论：李克强对中国经济的信心从哪里来？', '再来一个评论', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 18:03:10'),
(38, 7, 'administrator', 10, 'RE:【原创】如何用Badusb快速窃取资料', '我是17楼，但我是第16个回复的，这是为什么呢？因为楼主把一楼给吃了，哈哈哈哈', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 18:05:28'),
(39, 1, 'administrator', 6, 'RE:my frist article', '我是三楼哦', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-05 18:06:52'),
(40, 14, 'kali', 8, 'RE:哪位开国将领获赠“免死金牌”？ 曾降职8次', '[color=#f60]好厉害好厉害呀[/color]', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 10:42:29'),
(41, 16, '李鑫', 12, 'RE:评论：李克强对中国经济的信心从哪里来？', '我自己也要顶顶', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-04-06 12:40:58'),
(95, 16, 'administrator', 12, 'RE:评论：李克强对中国经济的信心从哪里来？', '什么时候才能上热门', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 20:27:56'),
(96, 2, 'administrator', 3, 'RE:[Android] QQ附近的人自动打招呼名片点赞新鲜事点赞QQ空间点赞', '测试看看能不说那个', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 20:29:32'),
(97, 2, 'administrator', 3, 'RE:[Android] QQ附近的人自动打招呼名片点赞新鲜事点赞QQ空间点赞', '11111111', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 20:30:28'),
(99, 16, 'administrator', 12, 'RE:评论：李克强对中国经济的信心从哪里来？ *', '有没有VPN', 0, 0, 0, '0000-00-00 00:00:00', NULL, '2016-05-06 22:43:05');

-- --------------------------------------------------------

--
-- 表的结构 `tg_dir`
--

CREATE TABLE `tg_dir` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//ID',
  `tg_name` varchar(20) NOT NULL COMMENT '//相册目录名',
  `tg_type` tinyint(1) UNSIGNED NOT NULL COMMENT '//相册类型',
  `tg_password` char(40) DEFAULT NULL COMMENT '//相册密码',
  `tg_content` varchar(200) DEFAULT NULL COMMENT '//相册描述',
  `tg_face` varchar(200) DEFAULT NULL COMMENT '//封面地址',
  `tg_dir` varchar(200) NOT NULL COMMENT '//相册存放路径',
  `tg_date` datetime NOT NULL COMMENT '//创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_dir`
--

INSERT INTO `tg_dir` (`tg_id`, `tg_name`, `tg_type`, `tg_password`, `tg_content`, `tg_face`, `tg_dir`, `tg_date`) VALUES
(1, '我的第一个公开相册', 0, NULL, '相册描述', 'monipic/moshou.jpg', 'photo/1460815995', '2016-04-16 22:13:15'),
(2, '我的第一个私密相册', 1, '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '111111', 'monipic/chinajoy.jpg', 'photo/1460816027', '2016-04-16 22:13:47');

-- --------------------------------------------------------

--
-- 表的结构 `tg_flower`
--

CREATE TABLE `tg_flower` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//ID',
  `tg_touser` varchar(20) NOT NULL COMMENT '//收花者',
  `tg_fromuser` varchar(20) NOT NULL COMMENT '//送花着',
  `tg_flower` mediumint(8) UNSIGNED NOT NULL COMMENT '//花朵个数',
  `tg_content` varchar(200) NOT NULL COMMENT '//感言',
  `tg_date` datetime NOT NULL COMMENT '//时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tg_friend`
--

CREATE TABLE `tg_friend` (
  `tg_id` mediumint(8) NOT NULL COMMENT '//ID',
  `tg_touser` varchar(20) NOT NULL COMMENT '//被添加的好友',
  `tg_fromuser` varchar(20) NOT NULL COMMENT '//添加的人',
  `tg_content` varchar(200) NOT NULL COMMENT '//请求内容',
  `tg_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//验证',
  `tg_date` datetime NOT NULL COMMENT '//添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_friend`
--

INSERT INTO `tg_friend` (`tg_id`, `tg_touser`, `tg_fromuser`, `tg_content`, `tg_state`, `tg_date`) VALUES
(1, 'admin', 'administrator', '我是administrator，希望和你成为朋友！', 1, '2016-07-14 11:05:30');

-- --------------------------------------------------------

--
-- 表的结构 `tg_message`
--

CREATE TABLE `tg_message` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//ID',
  `tg_touser` varchar(20) NOT NULL COMMENT '//收信人',
  `tg_fromuser` varchar(20) NOT NULL COMMENT '//发信人',
  `tg_content` varchar(200) NOT NULL COMMENT '//发信内容',
  `tg_state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//短信状态',
  `tg_date` datetime NOT NULL COMMENT '//发信时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_message`
--

INSERT INTO `tg_message` (`tg_id`, `tg_touser`, `tg_fromuser`, `tg_content`, `tg_state`, `tg_date`) VALUES
(1, '韩信', 'administrator', '韩信你好，我是administrator', 1, '2016-02-14 19:20:47'),
(2, '罗灿', 'administrator', '罗灿，我是你哥哥~~~~~~~~~~~~~~~~~~~~~', 0, '2016-02-14 19:22:08'),
(3, 'administrator', '韩信', '管理员你好，我要举报刘邦！', 0, '2016-02-15 17:19:48'),
(4, '王子', '刘邦', '你把韩信叫来杀了他', 0, '2016-02-15 17:22:35'),
(5, 'administrator', '刘邦', '今儿天气不错啊！', 1, '2016-02-15 17:26:05'),
(6, 'administrator', '罗灿', 'Hi,my name is LuoCan.', 1, '2016-02-15 17:27:02'),
(7, 'administrator', '李鑫', '我是学霸李鑫，啊哈哈哈哈哈！！！', 1, '2016-02-15 17:27:51'),
(8, 'administrator', '王麻子', '你晓不晓得风车车在哪儿？', 0, '2016-02-15 17:28:36'),
(12, 'administrator', '王麻子', '我都吃完早饭了。。。。', 1, '2016-02-15 18:23:52'),
(29, '刘邦', 'administrator', '你给我出来。。。。', 1, '2016-02-17 13:34:23'),
(21, 'administrator', 'langzi', '你问我爱你有多深？', 0, '2016-02-15 18:31:17'),
(22, '陈露萍', 'langzi', 'Hi,好久不见', 0, '2016-02-15 18:31:49'),
(23, 'ls110704214', 'langzi', '你是我的最常用的 用户名', 0, '2016-02-15 18:32:11'),
(24, '张潇文', 'langzi', '飘飘，走我们打游戏去', 0, '2016-02-15 18:32:48'),
(25, '杨雪', 'langzi', '媳妇儿，我最喜欢你了', 0, '2016-02-15 18:33:07'),
(26, '陈建强', 'langzi', '你就是大帅B？？？？？我不服', 0, '2016-02-15 18:33:34'),
(27, '王东', 'langzi', '哈哈，你是王小东', 0, '2016-02-15 18:33:55'),
(28, '韩信', 'administrator', '你死定了', 1, '2016-02-16 14:32:10'),
(48, '张华', 'administrator', '你的文章很棒哦', 1, '2016-04-04 18:32:26'),
(31, 'administrator', '刘邦', '我是汉武大帝刘邦。', 0, '2016-02-17 14:41:40'),
(32, 'administrator', '刘邦', '你服不服？', 1, '2016-02-17 14:41:55'),
(33, 'administrator', '张华', '我是来自21世纪的张华.', 1, '2016-02-17 14:42:52'),
(43, 'hack_langzi', 'administrator', '1111111111111111111', 0, '2016-02-18 17:22:45'),
(42, '王子', 'administrator', '年QQ啊大大的   阿打算', 0, '2016-02-18 17:15:40'),
(39, '罗灿', 'administrator', '罗倩倩，做作业啦', 0, '2016-02-18 15:48:27'),
(38, 'hack_langzi', 'administrator', '你是黑客嘛？', 0, '2016-02-18 15:47:59'),
(46, '罗灿', 'administrator', '111111', 1, '2016-02-19 12:41:01'),
(51, '5201314', 'administrator', 'qqqqqqqqqqqqqqqqqqqqqq', 0, '2016-04-09 17:31:15'),
(49, 'administrator', 'kali', '看了你的文章', 1, '2016-04-04 21:13:31'),
(50, 'kali', '张华', '谢谢你的评论', 1, '2016-04-06 13:42:04'),
(52, 'administrator', '韩信88', '222222222222222222', 1, '2016-04-09 21:00:21'),
(54, '刘邦', 'administrator', '同学你要不要买个vpn啊，很便宜哦，不买就**', 1, '2016-05-07 11:36:11'),
(55, 'admin', 'administrator', '你好', 0, '2016-07-14 11:05:38');

-- --------------------------------------------------------

--
-- 表的结构 `tg_photo`
--

CREATE TABLE `tg_photo` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//ID',
  `tg_name` varchar(20) NOT NULL COMMENT '//图片名',
  `tg_url` varchar(200) NOT NULL COMMENT '//图片路径',
  `tg_content` varchar(200) DEFAULT NULL COMMENT '//图片简介',
  `tg_sid` mediumint(8) UNSIGNED NOT NULL COMMENT '//图片所属相册ID',
  `tg_username` varchar(20) NOT NULL COMMENT '//上传者',
  `tg_readcount` smallint(5) NOT NULL COMMENT '//浏览量',
  `tg_commendcount` smallint(5) NOT NULL COMMENT '//评论量',
  `tg_date` datetime NOT NULL COMMENT '//上传时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_photo`
--

INSERT INTO `tg_photo` (`tg_id`, `tg_name`, `tg_url`, `tg_content`, `tg_sid`, `tg_username`, `tg_readcount`, `tg_commendcount`, `tg_date`) VALUES
(1, 'QQbug', 'photo/1460815995/1461321360.jpg', '这个图片可以让安卓设备崩溃！', 1, 'Administrator', 77, 1, '2016-04-22 18:36:20'),
(23, '公开照片2', 'photo/1460815995/1461500106.jpg', '公开照片2', 1, '刘邦', 11, 0, '2016-04-24 20:15:08'),
(22, '公开照片1', 'photo/1460815995/1461500092.jpg', '公开照片1', 1, '刘邦', 12, 0, '2016-04-24 20:14:54'),
(21, '私密照片9', 'photo/1460816027/1461500069.jpg', '私密照片9', 2, '刘邦', 12, 0, '2016-04-24 20:14:31'),
(20, '私密照片8', 'photo/1460816027/1461500047.jpg', '私密照片8', 2, '刘邦', 6, 0, '2016-04-24 20:14:09'),
(19, '私密照片7', 'photo/1460816027/1461500027.jpg', '私密照片7', 2, '刘邦', 7, 0, '2016-04-24 20:13:49'),
(18, '私密照片6', 'photo/1460816027/1461500014.jpg', '私密照片6', 2, '刘邦', 4, 0, '2016-04-24 20:13:35'),
(17, '私密照片5', 'photo/1460816027/1461499999.jpg', '私密照片5', 2, '刘邦', 4, 0, '2016-04-24 20:13:21'),
(16, '私密照片4', 'photo/1460816027/1461499985.jpg', '私密照片4', 2, '刘邦', 6, 0, '2016-04-24 20:13:07'),
(15, '私密照片3', 'photo/1460816027/1461499973.jpg', '私密照片3', 2, '刘邦', 5, 0, '2016-04-24 20:12:54'),
(14, '私密照片2', 'photo/1460816027/1461499955.jpg', '私密照片2', 2, '刘邦', 5, 0, '2016-04-24 20:12:38'),
(13, '私密照片1', 'photo/1460816027/1461499941.jpg', '私密照片1', 2, '刘邦', 5, 0, '2016-04-24 20:12:23'),
(24, '公开照片3', 'photo/1460815995/1461500120.jpg', '公开照片3', 1, '刘邦', 15, 0, '2016-04-24 20:15:22'),
(25, '公开照片4', 'photo/1460815995/1461500133.jpg', '公开照片4', 1, '刘邦', 121, 0, '2016-04-24 20:15:34'),
(26, '公开照片5', 'photo/1460815995/1461500147.jpg', '公开照片5', 1, '刘邦', 151, 0, '2016-04-24 20:15:48'),
(27, '公开照片6', 'photo/1460815995/1461500161.jpg', '公开照片6', 1, '刘邦', 192, 11, '2016-04-24 20:16:03'),
(28, '公开照片7', 'photo/1460815995/1461500174.jpg', '公开照片7', 1, '刘邦', 11, 0, '2016-04-24 20:16:16'),
(29, '公开照片8', 'photo/1460815995/1461500188.jpg', '公开照片8', 1, '刘邦', 10, 0, '2016-04-24 20:16:29'),
(30, '公开照片9', 'photo/1460815995/1461500200.jpg', '公开照片9', 1, '刘邦', 21, 0, '2016-04-24 20:16:42'),
(31, '公开照片10', 'photo/1460815995/1461500221.jpg', '公开照片10', 1, '刘邦', 33, 0, '2016-04-24 20:17:02'),
(38, '桌面', 'photo/1460816027/1462335749.png', '桌面', 2, '刘邦', 4, 0, '2016-05-04 12:22:40'),
(40, '树莓派', 'photo/1460815995/1462441891.jpg', '树莓派', 1, '刘邦', 6, 0, '2016-05-05 17:51:46');

-- --------------------------------------------------------

--
-- 表的结构 `tg_photo_commend`
--

CREATE TABLE `tg_photo_commend` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//ID',
  `tg_title` varchar(20) NOT NULL COMMENT '//评论标题',
  `tg_content` varchar(200) NOT NULL COMMENT '//评论内容',
  `tg_sid` mediumint(8) UNSIGNED NOT NULL COMMENT '//图片ID',
  `tg_username` varchar(20) NOT NULL COMMENT '//评论者用户名',
  `tg_date` datetime NOT NULL COMMENT '//评论日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_photo_commend`
--

INSERT INTO `tg_photo_commend` (`tg_id`, `tg_title`, `tg_content`, `tg_sid`, `tg_username`, `tg_date`) VALUES
(1, 'RE:刘邦', '第一个相册评论！', 27, 'administrator', '2016-04-26 20:06:58'),
(2, 'RE:刘邦', '测试验证码', 27, 'administrator', '2016-04-26 20:10:33'),
(3, 'RE:公开照片6', 'aaaaaaaaaaa', 27, 'administrator', '2016-04-26 21:03:26'),
(4, 'RE:公开照片6', 'aaaaaaaaa', 27, 'administrator', '2016-04-26 21:03:30'),
(5, 'RE:公开照片6', 'sasa', 27, 'administrator', '2016-04-26 21:03:35'),
(6, 'RE:公开照片6', 'asasas', 27, 'administrator', '2016-04-26 21:03:40'),
(7, 'RE:公开照片6', 'ddd', 27, 'administrator', '2016-04-26 21:03:46'),
(8, 'RE:公开照片6', '[color=#000080]aaaaaaaaaaaaaaaaasd[/color]', 27, 'administrator', '2016-04-26 21:03:58'),
(9, 'RE:公开照片6', 'asasa', 27, 'administrator', '2016-04-26 21:04:06'),
(10, 'RE:公开照片6', 'sasa', 27, 'administrator', '2016-04-26 21:04:10'),
(11, 'RE:公开照片6', '喵喵~~我是韩信', 27, '韩信', '2016-04-28 09:30:24'),
(12, 'RE:QQbug', '真的么？我才不信', 1, '韩信', '2016-05-03 12:58:37');

-- --------------------------------------------------------

--
-- 表的结构 `tg_system`
--

CREATE TABLE `tg_system` (
  `tg_id` mediumint(8) NOT NULL COMMENT '//ID',
  `tg_webname` varchar(20) NOT NULL COMMENT '//网站名称',
  `tg_article` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//文章分页数',
  `tg_blog` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//博友分页数',
  `tg_photo` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//相册分页数',
  `tg_skin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//默认皮肤',
  `tg_string` varchar(200) NOT NULL COMMENT '//敏感字符',
  `tg_post` smallint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//发帖间隔',
  `tg_re` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//回帖间隔',
  `tg_code` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//验证码开关',
  `tg_register` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//注册开关'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_system`
--

INSERT INTO `tg_system` (`tg_id`, `tg_webname`, `tg_article`, `tg_blog`, `tg_photo`, `tg_skin`, `tg_string`, `tg_post`, `tg_re`, `tg_code`, `tg_register`) VALUES
(1, '凌云网络', 12, 10, 10, 1, '你妈|艹|我日|VPN|vpn|法轮功|TMD|我操|SB|SX|草你|麻痹', 300, 30, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tg_user`
--

CREATE TABLE `tg_user` (
  `tg_id` mediumint(8) UNSIGNED NOT NULL COMMENT '//用户自动编号',
  `tg_uniqid` char(40) NOT NULL COMMENT '//唯一标识符',
  `tg_active` char(40) NOT NULL COMMENT '//激活登录用户',
  `tg_username` varchar(20) NOT NULL COMMENT '//用户名',
  `tg_password` char(40) NOT NULL COMMENT '//密码',
  `tg_question` varchar(20) NOT NULL COMMENT '//提问',
  `tg_answer` char(40) NOT NULL COMMENT '//回答',
  `tg_email` varchar(40) DEFAULT NULL COMMENT '//邮箱',
  `tg_qq` varchar(10) DEFAULT NULL COMMENT '//QQ',
  `tg_url` varchar(40) DEFAULT NULL COMMENT '//个人主页',
  `tg_sex` char(1) NOT NULL COMMENT '//性别',
  `tg_face` char(17) NOT NULL DEFAULT '0' COMMENT '//头像',
  `tg_switch` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//个性签名开关',
  `tg_autograph` varchar(40) DEFAULT NULL COMMENT '//个性签名内容',
  `tg_flower` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//花朵总数',
  `tg_level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//用户等级',
  `tg_last_post_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '//最后发帖时间',
  `tg_last_rearticle_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '//最后回帖时间',
  `tg_reg_time` datetime NOT NULL COMMENT '//注册时间',
  `tg_last_time` datetime NOT NULL COMMENT '//最后登陆时间',
  `tg_last_ip` varchar(20) NOT NULL COMMENT '//最后登录IP',
  `tg_login_count` smallint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '//登录次数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_user`
--

INSERT INTO `tg_user` (`tg_id`, `tg_uniqid`, `tg_active`, `tg_username`, `tg_password`, `tg_question`, `tg_answer`, `tg_email`, `tg_qq`, `tg_url`, `tg_sex`, `tg_face`, `tg_switch`, `tg_autograph`, `tg_flower`, `tg_level`, `tg_last_post_time`, `tg_last_rearticle_time`, `tg_reg_time`, `tg_last_time`, `tg_last_ip`, `tg_login_count`) VALUES
(24, '1c0af8e2b5f2d559c08b572168931ad5cb49a974', '', '罗爽', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '我的生日', '1e7b12d3aec25267efe167cb467ca2574b569b2b', '550060345@qq.com', '1120704214', 'www.qq.com', '男', 'image/face/4.png', 0, NULL, 0, 1, '0', '0', '2016-01-09 23:52:30', '2016-02-12 21:26:08', '::1', 2),
(32, '9174a9eea0ccde89def6440142350d9fba338a57', '', '陈建强', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '我的名字', '1afe2ee875e3c24d3df19b34f9f908daf7689f11', 'chenjianqiang@163.com', '252466852', 'http://cjq.com.cn', '男', 'image/face/4.png', 0, NULL, 0, 0, '0', '0', '2016-01-10 16:39:12', '2016-02-12 21:26:08', '::1', 2),
(46, '92d12410f59b51e5f765f2a08d0567a97d8505bb', '', '罗灿', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '是不是笨蛋？', '43de9ee222b6706a8b49bb0941b32506d69b5cd6', 'luoqian@163.com', '', '', '女', 'image/face/10.png', 0, NULL, 2, 0, '0', '0', '2016-01-30 15:11:01', '2016-04-05 12:49:50', '::1', 6),
(33, '194042a7399121e5bbfbd2b32a2388d2f7eb7f71', '', '郑路', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '我的女朋友名字', '38101871939aa7f92da742ec76aeb841e5f02ed1', 'zhenglu@foxmail.com', '565236566', '', '男', 'image/face/10.png', 0, NULL, 0, 0, '0', '0', '2016-01-10 16:41:41', '2016-02-12 21:26:08', '::1', 2),
(27, 'b5af2f3e62b8eb07f879c4d30617bbf86efb5d87', '', '王东', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'wangdong@qq.com', '115475266', 'http://sui.me', '女', 'image/face/6.png', 0, NULL, 0, 0, '0', '0', '2016-01-10 00:18:31', '2016-02-12 21:26:08', '::1', 2),
(35, '9fcc7b114873c4baa04985f1809cc2fd2d67b6af', '', '杨雪', 'b55542ba5f7d19fa1ab0b19efe29989dab1dd1cb', '我亲爱的是谁？', '6ed6029e2b24ac9f5d3085a0329d0f97a2467a7a', '676144262@qq.com', '676144262', 'http://user.qzone.qq.com/676144262', '女', 'image/face/6.png', 0, NULL, 0, 0, '0', '0', '2016-01-10 16:52:25', '2016-02-12 21:26:08', '::1', 2),
(36, 'a6729ffbf3a97db9c0a849ab88822d4fb0c2b4ff', '', '陈露萍', '979bd68391126704843e248932b5319895da9499', '几年级？', '0b48f196fbf9d5652ed7fd33ec8d7ef5ece52c51', 'chengluping@126.com', '1293292238', '', '女', 'image/face/1.png', 0, NULL, 0, 0, '0', '0', '2016-01-18 15:37:33', '2016-02-12 21:26:08', '::1', 2),
(37, '19f59ff27b11a64a0f354166dbf779a3a11099f2', '', '张潇文', '2e9fd9c13157e1bd33544df75c00c7a3e39fef3c', '什么社团？', 'b224873d4f58ac4c8ff76c545106fe6c659cc30f', 'zhangxiaowen@sina.com.cn', '266526565', '', '女', 'image/face/7.png', 0, NULL, 0, 0, '0', '0', '2016-01-19 16:12:45', '2016-02-12 21:26:08', '::1', 2),
(38, '8095a3d4e7244b1794b15e0c1974624025178843', '', '王佳', 'c4355e98b72a46738201086c3ed5306d9d38d60e', '小学名？', 'a400fd5f21ca7e05f991e941ad363b71ce76dc48', 'wangjiamiss@edu.cn', '256256665', '', '男', 'image/face/4.png', 0, NULL, 0, 0, '0', '0', '2016-01-19 16:30:56', '2016-02-12 21:26:08', '::1', 2),
(39, '20ff4b218594465c14cb1d529e8461eeb0cbef2a', '', 'ls110704214', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '数字？五位', '69df79bef9287d3bcb8f104a408b06de6a108fd8', '18781817437@163.com', '550060345', '', '男', 'image/face/5.png', 0, NULL, 0, 1, '0', '0', '2016-01-27 22:50:54', '2016-02-12 21:26:08', '::1', 2),
(40, 'b7205b6170c494dca8ed9332f6f714738ed29702', '', 'langzi', 'd852ea76c26ca657d4df735929fc60ee765c01cc', 'langzi', '69df79bef9287d3bcb8f104a408b06de6a108fd8', 'langzi@163.com', '', '', '女', 'image/face/8.png', 0, NULL, 0, 0, '0', '0', '2016-01-30 12:42:50', '2016-02-15 18:30:30', '::1', 3),
(41, 'bbd6fa82f58a103ea5a37d75670b823120c9bf3c', '', '张三', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '123', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'asdasd@qq.com', '', '', '男', 'image/face/1.png', 0, NULL, 0, 0, '0', '0', '2016-01-30 14:53:45', '2016-02-12 21:26:08', '::1', 2),
(42, 'b663b531a86eb75d769e48adde66398550277396', '', '李四', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '456', 'fc1200c7a7aa52109d762a9f005b149abef01479', '151513@qq.com', '', '', '女', 'image/face/1.png', 0, NULL, 0, 0, '0', '0', '2016-01-30 14:54:32', '2016-02-12 21:26:08', '::1', 2),
(43, 'a9e4cd9d3fea44af9f0754c02657bf9ee1b91073', '', '王麻子', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '789', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'asdasd@qq.com', '', '', '男', 'image/face/7.png', 0, NULL, 0, 0, '0', '0', '2016-01-30 14:55:12', '2016-02-15 17:28:11', '::1', 3),
(44, '681c2e56658b00d5118d9fa3dfc3c7089937552b', '', '张华', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '456', 'fc1200c7a7aa52109d762a9f005b149abef01479', '2565665@qq.com', '', '', '男', 'image/face/5.png', 0, NULL, 4, 0, '1460088831', '1460088889', '2016-01-30 14:56:04', '2016-04-08 12:08:06', '::1', 8),
(45, 'a995559de1072cca6629d92adfe6ed70e1ab4666', '', '李鑫', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '789', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '888888@ww.com', '', '', '女', 'image/face/6.png', 0, NULL, 2, 0, '0', '0', '2016-01-30 14:56:49', '2016-04-06 10:52:23', '::1', 7),
(47, '1eb808d5360bb332a6c9db40d0980259cfddc0a6', '', 'administrator', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '用户名？', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', 'admin@foxmail.com', '48755681', 'http://www.dahan.com.cn', '男', 'image/face/10.png', 1, '日出东方，唯我不败！', 126, 1, '1462598267', '1462598310', '2016-01-31 20:37:33', '2016-07-14 11:03:37', '127.0.0.1', 219),
(48, '28c55b5fd7a63da6decb7d8d19899e547a1fae91', '', 'hack_langzi', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '你猜？', 'e83699cc9090b15c18e77df5eb32fa8bf304f7d5', 'hack@red.com', '458665266', '', '女', 'image/face/3.png', 0, NULL, 0, 0, '0', '0', '2016-01-31 20:38:44', '2016-02-12 21:26:08', '::1', 2),
(49, 'af522716bd94e642a73480fcbd520fac36a0bb7d', '', '王子', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '白雪？', '53f6f9b919ac48dcb7b4729a5a0824ef1ee2da74', 'baixue@qq.com', '', '', '女', 'image/face/9.png', 0, NULL, 0, 0, '0', '0', '2016-01-31 20:39:41', '2016-02-12 21:26:08', '::1', 2),
(50, '8c068b86b3bf45fb35d117a04284e8ef1f1dfaad', '', '韩信', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '我的朝代？', '48b6fdfcb893d30d8f7dbd83190ca8da9ad417d8', 'hanxin@han.com', '25251325', 'http://www.dahan.com.cn', '女', 'image/face/1.png', 0, NULL, 15, 0, '1462535740', '0', '2016-01-31 20:41:28', '2016-05-06 19:56:24', '127.0.0.1', 25),
(51, 'c35a1abadd7c874b8439a56cd45fb35d3698b21a', '', '刘邦', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '我手下大将？', '094aa21e75e50a7c60362a1e6e52cac9435b7aec', 'liubang@dahan.com', '', '', '男', 'image/face/1.png', 1, '我是刘邦，那个韩信就是被我杀死的！', 37, 0, '1462538130', '1462278004', '2016-01-31 20:42:31', '2016-05-07 12:00:29', '127.0.0.1', 45),
(52, 'c5e6bdd94d4caf2bdd8a982e5c5733ccf68bb9b1', '', 'study-php', 'd852ea76c26ca657d4df735929fc60ee765c01cc', '我喜欢的语言？', '47425e4490d1548713efea3b8a6f5d778e4b1766', 'studyphp@qq.com', '', 'http://www.php.com.cn', '男', 'image/face/2.png', 0, NULL, 2, 0, '0', '0', '2016-02-01 15:17:39', '2016-04-05 10:59:35', '::1', 7),
(53, 'd8cd0d70617376b1e6dcd6791b86a5fc9e477bd0', '', 'kali', 'd852ea76c26ca657d4df735929fc60ee765c01cc', 'kali', 'ba324ca7b1c77fc20bb970d5aff6eea9377918a5', 'kali@linux.cn', '', '', '女', 'image/face/1.png', 0, NULL, 5, 0, '0', '0', '2016-02-19 15:04:19', '2016-04-06 13:42:53', '::1', 7),
(54, 'b81e8153cb2d188e86c89706ce91eb0062d63945', '', 'root', '09bd1414753cc10a052074f09f8d5df5baeea8dd', 'root', '435b41068e8665513a20070c033b08b9c66e4332', 'root@localhost.com', '', '', '女', 'image/face/5.png', 0, NULL, 0, 0, '0', '0', '2016-02-23 12:53:18', '2016-02-23 12:53:18', '192.168.233.129', 0),
(56, '6eb7184abb6e1a065299f76f0bac6dc589d3e6d8', '', 'father', 'd852ea76c26ca657d4df735929fc60ee765c01cc', 'father', 'f224c89a2fa0f518efde03de00608b519ef92399', 'father@home.com', '', '', '女', 'image/face/8.png', 0, NULL, 0, 0, '0', '0', '2016-02-23 13:11:29', '2016-02-23 13:11:29', '192.168.233.129', 0),
(62, 'a05d7a32fc6cea1987497abfbbde03c67edf83ac', '', 'python', 'd852ea76c26ca657d4df735929fc60ee765c01cc', 'my name is?', '4235227b51436ad86d07c7cf5d69bda2644984de', 'python@localhost.com', '', '', '女', 'image/face/10.png', 0, NULL, 0, 0, '0', '0', '2016-02-23 13:22:46', '2016-02-23 13:22:46', '192.168.233.129', 0),
(99, '841b535ba6769a91158d00e9bbec82a806c82488', '', 'admin', 'eaeb8c1250f18a13b72c212ceb85f4cfc100f817', 'admin', 'eaeb8c1250f18a13b72c212ceb85f4cfc100f817', 'f4ck_langzi@foxmail.com', '1120704214', 'http://119.29.38.234', '女', 'image/face/3.png', 0, NULL, 6, 1, '0', '0', '2016-07-14 10:03:29', '2016-07-14 11:05:53', '127.0.0.1', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tg_article`
--
ALTER TABLE `tg_article`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_dir`
--
ALTER TABLE `tg_dir`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_flower`
--
ALTER TABLE `tg_flower`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_friend`
--
ALTER TABLE `tg_friend`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_message`
--
ALTER TABLE `tg_message`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_photo`
--
ALTER TABLE `tg_photo`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_photo_commend`
--
ALTER TABLE `tg_photo_commend`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_system`
--
ALTER TABLE `tg_system`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `tg_user`
--
ALTER TABLE `tg_user`
  ADD PRIMARY KEY (`tg_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tg_article`
--
ALTER TABLE `tg_article`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=102;
--
-- 使用表AUTO_INCREMENT `tg_dir`
--
ALTER TABLE `tg_dir`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `tg_flower`
--
ALTER TABLE `tg_flower`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//ID';
--
-- 使用表AUTO_INCREMENT `tg_friend`
--
ALTER TABLE `tg_friend`
  MODIFY `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `tg_message`
--
ALTER TABLE `tg_message`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=56;
--
-- 使用表AUTO_INCREMENT `tg_photo`
--
ALTER TABLE `tg_photo`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=47;
--
-- 使用表AUTO_INCREMENT `tg_photo_commend`
--
ALTER TABLE `tg_photo_commend`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `tg_system`
--
ALTER TABLE `tg_system`
  MODIFY `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '//ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `tg_user`
--
ALTER TABLE `tg_user`
  MODIFY `tg_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//用户自动编号', AUTO_INCREMENT=100;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
