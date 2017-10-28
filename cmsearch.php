<?php
$command = $_POST['command'];
$arg = $_POST['text'];

/* Begin commands */

/* cmsearch: searches by term */
if($command === "/cmsearch")
{
  $url = "https://api.cymon.io/v2/ioc/search/term/".$arg."?startDate=2017-03-25&endDate=2017-03-29&from=0&size=3";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = json_decode((curl_exec($ch)), TRUE);
  $reply = "*Total of ".$result['total']." results searching with term ".$arg.". Displaying first 3.*\n";

  /* loop through hit array and concatenate info to result string */
  foreach($result['hits'] as $hit)
  {
    $hitinfo = "---\n*".$hit['feed']."* - ".$hit['title']." | Feed ID: ".$hit['feed_id']."\n".$hit['description']."\n---";
    $reply = $reply.$hitinfo;
  }

  echo $reply;
}
/* cminfo: displays info by feed id */
else if($command === "/cminfo")
{
  $url = "https://api.cymon.io/v2/feeds/".$arg;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = json_decode((curl_exec($ch)), TRUE);
  $reply = "*Displaying info for feed with id ".$arg.".*\n";

  $reply = $reply . "*Name:* ".$result['name']."\n";
  $reply = $reply . "*Description:* ".$result['description']."\n";
  $reply = $reply . "*Link:* ".$result['link']."\n";

  echo $reply;
}
/* cmdomain: searches by domain */
else if($command === "/cmdomain")
{
  $url = "https://api.cymon.io/v2/ioc/search/domain/".$arg."?startDate=2017-03-25&endDate=2017-03-29&from=0&size=3";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = json_decode((curl_exec($ch)), TRUE);
  $reply = "*Total of ".$result['total']." results searching with domain ".$arg.". Displaying first 3.*\n";

  /* loop through hit array and concatenate info to result string */
  foreach($result['hits'] as $hit)
  {
    $hitinfo = "---\n*".$hit['feed']."* - ".$hit['title']." | Feed ID: ".$hit['feed_id']."\n".$hit['description']."\n---";
    $reply = $reply.$hitinfo;
  }

  echo $reply;
}
/* cmshelp: display help message */
else if($command === "/cmshelp")
{
  $reply = "*_Cmsearch (Cymon Search) Help:_*\n
    *List of available commands:*\n
    /cmsearch [term] - _Searches for Cymon feeds by term_\n
    /cminfo [feed ID] - _Displays information about a feed_\n
    /cmshelp - _Gets you this message_\n";

    echo $reply;
}
/* copypasta: posts a random bad meme */
else if($command === "/copypasta")
{
  /* huge copypasta array incoming */
  $copypastas = array(
    "DO IT, just DO IT! Don’t let your dreams be dreams. Yesterday, you said tomorrow. So just. DO IT! Make. your dreams. COME TRUE! Just… do it! Some people dream of success, while you’re gonna wake up and work HARD at it! NOTHING IS IMPOSSIBLE!You should get to the point where anyone else would quit, and you’re not gonna stop there. NO! What are you waiting for? … DO IT! Just… DO IT! Yes you can! Just do it! If you’re tired of starting over, stop. giving. up.",
    "Don't👏 pretend👏 to 👏be 👏entitled👏 to👏 financial👏 compensation👏 if 👏you 👏or👏 a👏 loved 👏one 👏hasn't👏 even 👏been 👏diagnosed👏 with 👏mesothelioma", "To be fair, you have to have a very high IQ to understand Rick and Morty. The humour is extremely subtle, and without a solid grasp of theoretical physics most of the jokes will go over a typical viewers head. There's also Rick's nihilistic outlook, which is deftly woven into his characterisation- his personal philosophy draws heavily from Narodnaya Volya literature, for instance. The fans understand this stuff; they have the intellectual capacity to truly appreciate the depths of these jokes, to realise that they're not just funny- they say something deep about LIFE. I'm smirking right now just imagining one of those addlepated simpletons scratching their heads in confusion as Dan Harmon's genius wit unfolds itself on their television screens. What fools.. how I pity them. 😂", "This 👈👉 is money snek. 🐍🐍💰💰 Upsnek ⬆⬆🔜🔜 in 7.123 7⃣ 1⃣2⃣3⃣ snekonds 🐍🐍 or you ✋✋ will NEVER ❌❌❌❌ get monies 💰💰 again\nBeware!! ✋✋❌❌ You😏😏 don't ❌❌ have much time!!🕛🕧🕐🕜🕑🕝🕝 You 😏😏 may never ❌❌get monies 💰💰🐍💰💰 again!!", "According to all known laws of aviation, there is no way a bee should be able to fly. Its wings are too small to get its fat little body off the ground. The bee, of course, flies anyway because bees don’t care what humans think is impossible. Yellow, black. Yellow, black. Yellow, black. Yellow, black. Ooh, black and yellow! Let’s shake it up a little. Barry! Breakfast is ready! Ooming! Hang on a second. Hello? - Barry? - Adam? - Oan you believe this is happening? - I can’t. I’ll pick you up. Looking sharp. Use the stairs. Your father paid good money for those. Sorry. I’m excited. Here’s the graduate. We’re very proud of you, son. A perfect report card, all B’s."
  );

  shuffle($copypastas);

  echo $copypastas[0];
}
