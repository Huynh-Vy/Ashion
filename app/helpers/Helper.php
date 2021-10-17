<?php

class Helper
{
    public static function statusActive($value = 1)
    {
        return $value == 1 ? '<span class="badge bg-success">Kích Hoạt</span>' 
                            : '<span class="badge bg-danger">Không Kích Hoạt</span>';
    }

    public static function page($sum, $limit = 5, $link = '', int $pageNow = 1, $offsetPage = 3)
    {
        $html = '<ul class="pagination pagination-sm m-0 float-right">';

        #Tính số page
        $page = ceil($sum / $limit);

        if ($pageNow > 1) { #Nếu trang hiện tại lớn hơn 1
            $html .= '<li class="page-item"><a class="page-link" href="' .$link. '"><i class="fas fa-angle-double-left"></i></a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="' .$link. '"><i class="fas fa-angle-left" style="font-weight:600"></i></a></li>';
        }

        #Tính start và end
        #Start
        if ($pageNow - $offsetPage > 0) {  #Nếu trang hiện tại - 3 > 0 (nghĩa là vẫn còn nhiều hơn 3 trang)
            $start = $pageNow - $offsetPage;
        } else {
            $start = 1;
        }

        #Check ĐK
        if ($page - $pageNow > $offsetPage) { #Nếu tổng trang - trang hiện tại mà lớn hơn 3
            $end = $pageNow + $offsetPage; 
        } else {
            #Ngược lại thì lấy trang hiện tại + (cho tổng trang - trang hiện tại)
            $end = $pageNow + ($page - $pageNow); 
        }


        for ($i = $start; $i <= $end; $i++) {
            if ($pageNow == $i) { #NẾu trang hiện tại = $I
                $html .= '<li class="page-item"><a class="page-link" href="">' . $i . '</a></li>';
            } else {
                $html .= '<li class="page-item"><a class="page-link" href="' .$link. '" >' . $i . '</a></li>';
            }
        }

        if ($pageNow < $page) {
            $html .= '<li class="page-item"><a class="page-link" href="' .$link. '"><i class="fas fa-angle-right"></i></a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="' .$link. '"><i class="fas fa-angle-double-right"></i></a></li>';
        }

        $html .= '</ul>';
        return $html;
    }

    public static function getFolder($path = './public/uploads/')
    {
        $year = date("Y");
        $month = date("m");
        $day = date("d");

        if (!is_dir($path . $year)) {
            mkdir($path . $year, 0755);
        }

        if (!is_dir($path . $year . '/' . $month)) {
            mkdir($path . $year . '/' . $month, 0755);
        }

        if (!is_dir($path . $year . '/' . $month . '/' . $day)) {
            mkdir($path . $year . '/' . $month . '/' . $day, 0755);
        }

        return $path . $year . '/' . $month . '/' . $day . '/';
    }

    public static function getAllMenu()
    {
        $db = new DB;
        $sql = "SELECT * from menus 
                where active = 1 && is_delete is NULL
                order by sort asc";

        return $db->query($sql);
    }

    static public function price($price = 0, $priceSale = 0)
    {
        # Nếu giá gốc và giá giảm khác 0
        if ($price != 0 && $priceSale != 0) {
            return '
            <span class="default">'. number_format($priceSale) .'<sup>đ</sup></span>
            <span class="sale">'. number_format($price) .'<sup>đ</sup></span>
            '; 
        }

        # Nếu giá gốc khác 0 và giá giảm bằng 0
        if ($price != 0 && $priceSale == 0) {
            return '
            <span class="default">'. number_format($price) .'<sup>đ</sup></span>';
        }
        return '<a href="lien-he.html" title="Liên Hệ">Liên Hệ</a>';
    }

    public static function productSale()
    {
        $db = new DB();

        $sql = "SELECT id, name, price, price_sale, thumb from products
                where active  = 1
                order by sort desc
                limit 8";

        return $db->query($sql);
    }

}