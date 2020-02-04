# 毕设项目接口规划

## 1.用户管理模块
- ``/user/login.do``
- ``/user/register.do``
- ``/user/logout.do``
- ``/user/changeName.do``更改用户名
- ``/manage/user/login.do``
- ``/manage/user/edit.do``更改用户权限
- ``/manage/user/delete.do``删除用户

## 2.产品分类模块

- ``/manage/category/add.do``增加分类
- ``/manage/category/edit.do``编辑分类
- ``/manage/category/delete.do``删除分类
- ``/manage/category/list.do``展示分类(体现层级)

## 3.产品模块
- ``/manage/product/add.do``增加产品
  - ``/manage/feature/add.do``新增产品特性
    - ``/manage/feature_item/add.do``新增产品特性选项
- ``/manage/product/edit.do``编辑产品
  - ``/manage/feature/edit.do``编辑产品特性
    - ``/manage/feature_item/edit.do``编辑产品特性选项
- ``/manage/product/delete.do``删除产品
  - ``/manage/feature/delete.do``删除产品特性
    - ``/manage/feature_item/delete.do``删除一个产品特性选项
    - ``/manage/feature_item/deleteAll.do``删除一个产品特性时 同时删除所有关联选项
  - ``/manage/feature/delete_all.do``删除一个产品的所有特性
- ``/product/list.do``展示所有产品
- ``/product/search.do``模糊查找产品
- ``/product/detail.do``展示产品
  - ``/feature/list_all.do``展示一个商品的所有特性
- ``/product/list.do``获得产品列表(逛商店)

## 5.订单模块
- ``/order/create.do``
- ``/order/cancel.do``
- ``/order/list.do``


## 6.购物车模块
- ``/cart/add.do``
- ``/cart/delete.do``
- ``/cart/list.do``
- ``/cart/select.do``