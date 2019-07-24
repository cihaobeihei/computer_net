<?php
namespace app\common;

class MyConst
{

    public const CURRENT_USER = 'CURRENT_USER';

    public const TABLE_USER = 'user';

    public const TABLE_USER_ID_FIELD = 'id';

    public const TABLE_USER_USERNAME_FIELD = 'username';

    public const TABLE_USER_PWD_FIELD = 'password';

    public const TABLE_USER_BOARDID_FIELD = 'board_id';

    public const TABLE_USER_ROLE_FIELD = 'role';

    public const TABLE_BOARD = 'board';

    public const TABLE_BOARD_ID_FIELD = 'id';

    public const TABLE_BOARD_USERID_FIELD = 'user_id';

    public const TABLE_MESSAGE = 'message';

    public const TABLE_MESSAGE_ID_FIELD = 'id';

    public const TABLE_MESSAGE_BOARDID_FIELD = 'board_id';

    public const TABLE_MESSAGE_USERID_FIELD = 'user_id';

    public const TABLE_MESSAGE_CONTENT_FIELD = 'content';

    public const TABLE_MESSAGE_CREATETIME_FIELD = 'create_time';

    public const ROLE_CUSTOMER = 1;

    public const ROLE_ADMIN = 0;
}