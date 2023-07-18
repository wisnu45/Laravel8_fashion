<?php
namespace app\Helpers;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Self_;

class helper 
{
    public static function menu($menus,$parent_id=0,$char='') {
        $html ='';
       foreach($menus as $key =>$menu) {
      if($menu->parent_id == $parent_id) {
          $html .='
          <tr>
          <td class=" btn-primary btn-sm">'.$menu->id.'</td>
          <td>'.$char.'.'.$menu->name.'</td>
          <td>'.$menu->description.'</td>
          <td>'.$menu->content.'</td>
            <td>'.self::active($menu->active).'</td>
          <td>'.$menu->updated_at.'</td>
          <td>
            <a href="/admin/menus/edit/'.$menu->id.'" class="btn btn-primary btn-sm">Sửa</a>
            <a onClick="removeRow('.$menu->id.',\'/admin/menus/destroy\')" class="btn btn-danger btn-sm">Xóa</a>
          </td>
          </tr>
        
          ';
          unset($menus[$key]);
          $html .=self::menu($menus,$menu->id, $char .'--');
     
      }
       }
       return $html;
      
    }
    public static function active($active=0) {
       return $active==0 ? '<span class="btn btn-danger btn-sm">No</span>':
       '<span class=" btn btn-success btn-sm">Yes</span>';
        
    }
    public static function menus($menus,$parent_id=0) {
      $html = ' ';
      foreach($menus as $menu) {
        if($menu->parent_id==$parent_id) {
         $html .='
          <li>
          <a href="/danh-muc/'.$menu->id.'-'.Str::slug($menu->name).'">
            '.$menu->name.'
          </a>';
          if(self::isParent($menus,$menu->id))
          {
          $html .='
             <ul class="sub-menu">';
            $html .=self::menus($menus,$menu->id);
           $html .='  </ul> ';
         
          }
        $html .= '</li>'; 
         
        }
        
      
      }
      return $html;
    }
    public static function isParent($menus,$id) {
      foreach($menus as $menu)
      {
      if($menu->parent_id==$id) {
        return true;
      }
    }
      return false;
    }
    public static function getPrice($price,$price_sale) {
      if($price !=0)return number_format($price);
      if($price_sale !=0)return number_format($price_sale);
    }
}