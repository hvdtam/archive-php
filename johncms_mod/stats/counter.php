<?php
//by FlySelf
session_name('SESID');//��� ������
session_start(); //������ ������
$img = imageCreateFromGIF('icons/counter.gif');//����� ����������� ��� ��������
$color_hosty = imagecolorallocate($img, 255,255,255);//���� ������ ������
$color2_hity = imagecolorallocate($img, 11,11,107);//���� ������ �����
ImageString($img, 1, 3, 4, $_SESSION["host"], $color_hosty);//������� ����� �� �������
ImageString($img, 1, 38, 4, $_SESSION["hity"], $color_hity);//������� ���� �� �������
Header("Content-type: image/gif");
ImageGIF($img);
ImageDestroy($img);
?>