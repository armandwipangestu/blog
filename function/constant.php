<?php

function getName()
{
  return "nihSx";
}

function getLink($value)
{

  $LIST_LINK = [
    "https://t.me/armandwipangestu",
    "https://www.youtube.com/channel/UCqo9Q_EpEJWGJLB2xmm_g3A",
    "https://github.com/nihsx",
    "armandwi.pangestu7@gmail.com"
  ];

  if ($value == "Telegram") {
    return $LIST_LINK[0];
  } else if ($value == "YouTube") {
    return $LIST_LINK[1];
  } else if ($value == "GitHub") {
    return $LIST_LINK[2];
  } else if ($value == "Email") {
    return $LIST_LINK[3];
  }
}
