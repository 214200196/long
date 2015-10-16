        <!--左侧菜单选中菜单定义20150827-->
        <script type="text/javascript">
        // $(function(){
            // 左侧拦js效果修改20150827
            //$("#sidebar ul:first li:eq(2)").addClass("current");
         //});
                var pli = {$Think.get.pli|default=0};
                var cli = {$Think.get.cli|default=0};
        </script>

        <!--<script type="text/javascript">
            $ (function() {
                $("#sidebar ul:first li:eq(1)").addClass("current");
                $("#sidebar ul:first li:eq(1)").children().find("li:eq(1)").addClass("current");
            });
        </script>-->

        <div id="sidebar">
            <ul>
                <li>
                    <a href="{:U('Index/index')}">
                        <img src="<?php echo base_url('static');?>/img/icons/menu/home.png" alt="" />
                        首 页
                    </a>
                </li>
                <li><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/layout.png" alt="" /> 借款管理</a>
                    <ul>
                                                <li><a href="{:U('Borrow/index',array('pli'=>1,'cli'=>0))}">借款信息</a></li>

                                            </ul>
                </li>
                <li><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/users.png" alt="" /> 会员管理</a>
                    <ul>
                                                <li><a href="{:U('Member/index',array('pli'=>2,'cli'=>0))}">会员信息</a></li>

                                            </ul>
                </li>
                <li><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/money.png" alt="" /> 资金管理</a>
                    <ul>
                                                <li><a href="{:U('Borrow/index')}">会员信息</a></li>

                                            </ul>
                </li>
                <li ><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/page.png" alt="" /> 新闻管理</a>
                    <ul>
                                                <li><a href="{:U('Borrow/index')}">发布新闻</a></li>

                                            </ul>
                </li>
                 <li><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/chart.png" alt="" /> 数据统计</a>
                    <ul>
                                                <li><a href="{:U('Borrow/index')}">日报表</a></li>
                                            </ul>
                </li>
                <li><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/user.png" alt="" /> 管理员信息</a>
                    <ul>
                                                <li><a href="{:U('Admin/index',array('pli'=>6,'cli'=>0))}"> 管理员列表</a></li>
                                                <li><a href="{:U('Admin/addAdmin',array('pli'=>6,'cli'=>1))}">添加管理员</a></li>
                                                <li><a href="{:U('Admin/modifyAdmin',array('pli'=>6,'cli'=>2))}">修改个人资料</a></li>
                                            </ul>
                </li>
                <li><a href="#"><img src="<?php echo base_url('static');?>/img/icons/menu/settings.png" alt="" /> 系统设置</a>
                    <ul>
                                                <li><a href="{:U('Borrow/index')}"> 数据库备份</a></li>
            
                                            </ul>
                </li>

            </ul>


        </div>



                