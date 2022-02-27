<?php

function getName()
{
  return "nihSx";
}

function getDefaultTheme()
{
  return "bg-light text-dark";
}

function highlightDarkTheme()
{
  //return "atom-one-dark-reasonable";
  //return "hybrid";
  //return "dracula";
  return "github-dark-dimmed.min";
  //return "base16/onedark.min";
  //return "base16/material-darker.min";
  //return "atom-one-dark-reasonable.min";
}

function highlightLightTheme()
{
  //return "atom-one-light-reasonable.min";
  //return "base16/one-light.min";
  return "github.min";
}

function getLink($value)
{

  $LIST_LINK = [
    "https://t.me/armandwipangestu",
    "https://www.youtube.com/channel/UCqo9Q_EpEJWGJLB2xmm_g3A",
    "https://github.com/armandwipangestu",
    "armandwi.pangestu7@gmail.com",
    "http://blog.xshin.tech"
  ];

  if ($value == "Telegram") {
    return $LIST_LINK[0];
  } else if ($value == "YouTube") {
    return $LIST_LINK[1];
  } else if ($value == "GitHub") {
    return $LIST_LINK[2];
  } else if ($value == "Email") {
    return $LIST_LINK[3];
  } else if ($value == "Domain") {
    return $LIST_LINK[4];
  }
}

function getFavIcon()
{
  #return "assets/img/favicon/terminal.svg";
  return "assets/img/favicon/github.png";
}

function tagImg()
{
  return '
    <a href="..." target="_blank">
      <img src="..." alt="..." class="img-fluid rounded mx-auto d-block" />
    </a>
  ';
}
