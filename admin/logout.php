<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-22 19:31:18
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:35:15
 */
//页面退出，销毁session
session_start();
session_destroy();
header("refresh:2;url=login.html");