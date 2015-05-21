<?PHP

$champions = [];

$champions_key = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ,11 ,12 ,13 ,14 ,15 ,16 ,17 ,18 ,19 ,20 ,21 ,22 ,23 ,24 ,25 ,26 ,27 ,28 ,29 ,30 ,31 ,32 ,33 ,34 ,35 ,36 ,37 ,38 ,39 ,40 ,41 ,42 ,43 ,44 ,45 ,48 ,50 ,51 ,53 ,54 ,55 ,56 ,57 ,58 ,59 ,60 ,61 ,62 ,63 ,64 ,67 ,68 ,69 ,72 ,74 ,75 ,76 ,77 ,78 ,79 ,80 ,81 ,82 ,83 ,84 ,85 ,86 ,89 ,90 ,91 ,92 ,96 ,98 ,99, 101, 102, 103, 104, 105, 106, 107, 110, 111, 112, 113, 114, 115, 117, 119, 120, 121, 122, 126, 127, 131, 133, 134, 143, 150, 154, 157, 161, 201, 222, 236, 238, 254, 266, 267, 268, 412, 421, 429, 432); 


//$champions = "Champion, Damage Type, Summoner type, Lane";

// Temp Lane Array until going back to assoc array //





////

$champions[1] = array("Annie");
$champions[2] = array("Olaf");
$champions[3] = array("Galio");
$champions[4] = array("Twisted Fate");
$champions[5] = array("Xin Zhao");
$champions[6] = array("Urgot");
$champions[7] = array("LeBlanc");
$champions[8] = array("Vladimir");
$champions[9] = array("Fiddlesticks");
$champions[10] = array("Kayle");
$champions[11] = array("Master Yi");
$champions[12] = array("Alistar");
$champions[13] = array("Ryze");
$champions[14] = array("Sion");
$champions[15] = array("Sivir");
$champions[16] = array("Soraka");
$champions[17] = array("Teemo");
$champions[18] = array("Tristana");
$champions[19] = array("Warwick");
$champions[20] = array("Nunu");
$champions[21] = array("Miss Fortune");
$champions[22] = array("Ashe");
$champions[23] = array("Tryndamere");
$champions[24] = array("Jax");
$champions[25] = array("Morgana");
$champions[26] = array("Zilean");
$champions[27] = array("Singed");
$champions[28] = array("Evelynn");
$champions[29] = array("Twitch");
$champions[30] = array("Karthus");
$champions[31] = array("Cho'Gath");
$champions[32] = array("Amumu");
$champions[33] = array("Rammus");
$champions[34] = array("Anivia");
$champions[35] = array("Shaco");
$champions[36] = array("Dr. Mundo");
$champions[37] = array("Sona");
$champions[38] = array("Kassadin");
$champions[39] = array("Irelia");
$champions[40] = array("Janna");
$champions[41] = array("Gangplank");
$champions[42] = array("Corki");
$champions[43] = array("Karma");
$champions[44] = array("Taric");
$champions[45] = array("Veigar");
$champions[48] = array("Trundle");
$champions[50] = array("Swain");
$champions[51] = array("Caitlyn");
$champions[53] = array("Blitzcrank");
$champions[54] = array("Malphite");
$champions[55] = array("Katarina");
$champions[56] = array("Nocturne");
$champions[57] = array("Maokai");
$champions[58] = array("Renekton");
$champions[59] = array("Jarvan IV");
$champions[60] = array("Elise");
$champions[61] = array("Orianna");
$champions[62] = array("Wukong");
$champions[63] = array("Brand");
$champions[64] = array("Lee Sin");
$champions[67] = array("Vayne");
$champions[68] = array("Rumble");
$champions[69] = array("Cassiopeia");
$champions[72] = array("Skarner");
$champions[74] = array("Heimerdinger");
$champions[75] = array("Nasus");
$champions[76] = array("Nidalee");
$champions[77] = array("Udyr");
$champions[78] = array("Poppy");
$champions[79] = array("Gragas");
$champions[80] = array("Pantheon");
$champions[81] = array("Ezreal");
$champions[82] = array("Mordekaiser");
$champions[83] = array("Yorick");
$champions[84] = array("Akali");
$champions[85] = array("Kennen");
$champions[86] = array("Garen");
$champions[89] = array("Leona");
$champions[90] = array("Malzahar");
$champions[91] = array("Talon");
$champions[92] = array("Riven");
$champions[96] = array("Kog'Maw");
$champions[98] = array("Shen");
$champions[99] = array("Lux");
$champions[101] = array("Xerath");
$champions[102] = array("Shyvana");
$champions[103] = array("Ahri");
$champions[104] = array("Graves");
$champions[105] = array("Fizz");
$champions[106] = array("Volibear");
$champions[107] = array("Rengar");
$champions[110] = array("Varus");
$champions[111] = array("Nautilus");
$champions[112] = array("Viktor");
$champions[113] = array("Sejuani");
$champions[114] = array("Fiora");
$champions[115] = array("Ziggs");
$champions[117] = array("Lulu");
$champions[119] = array("Draven");
$champions[120] = array("Hecarim");
$champions[121] = array("Kha'Zix");
$champions[122] = array("Darius");
$champions[126] = array("Jayce");
$champions[127] = array("Lissandra");
$champions[131] = array("Diana");
$champions[133] = array("Quinn");
$champions[134] = array("Syndra");
$champions[143] = array("Zyra");
$champions[150] = array("Gnar");
$champions[154] = array("Zac");
$champions[157] = array("Yasuo");
$champions[161] = array("Vel'Koz");
$champions[201] = array("Braum");
$champions[222] = array("Jinx");
$champions[236] = array("Lucian");
$champions[238] = array("Zed");
$champions[254] = array("Vi");
$champions[266] = array("Aatrox");
$champions[267] = array("Nami");
$champions[268] = array("Azir");
$champions[412] = array("Thresh");
$champions[421] = array("RekSai");
$champions[429] = array("Kalista");
$champions[432] = array("Bard");

$lanes = [];

$lanes
?>      


