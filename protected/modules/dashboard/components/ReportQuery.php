<?php

class ReportQuery {

  public static function getFiveTopClients() {
    $sql = "
      select
          i.client_id
          ,count(i.invoice_id) as invoice_count
          ,sum(invoice_amount) as invoice_total
      from public.invoices i
      inner join sunat.type_invoices ti on (
          ti.typeinvoice_code = i.invoice_type
          and ti.status is true
          and ti.typeinvoice_code in ('01','03')
      )
      where i.status is true
      and i.invoice_status = 2
      group by 
          i.client_id
      order by 2 desc, 3 desc
      limit 5;
      ";

    $command = Yii::app()->db->createCommand($sql);

    return $command->queryAll();
  }
  
  public static function getFiveTopProducts() {
    $sql = "
      select
          ip.product_id
          ,count(distinct(i.invoice_id)) as invoice_count
          ,sum(ip.invoiceproduct_quantity) as product_count
          ,sum(ip.invoiceproduct_total) as product_total
      from public.invoices i
      inner join sunat.type_invoices ti on (
          ti.typeinvoice_code = i.invoice_type
          and ti.status is true
          and ti.typeinvoice_code in ('01','03')
      )
      inner join public.invoice_products ip on (
          ip.invoice_id = i.invoice_id
          and ip.status is true
      )
      where i.status is true
      and i.invoice_status = 2
      group by 
          ip.product_id
      order by 3 desc, 4 desc
      limit 5;
      ";

    $command = Yii::app()->db->createCommand($sql);

    return $command->queryAll();
  }

  public static function getAverageDailySummary($year) {
    $sql = "
      select
          count(report.invoice_day) as total_days
          ,sum(report.invoice_count) as total_invoices
      from (
          select
              to_char(i.invoice_date_created, 'YYYY') as invoice_year
              ,to_char(i.invoice_date_created, 'MM') as invoice_month
              ,to_char(i.invoice_date_created, 'DD') as invoice_day
              ,count(i.invoice_id) as invoice_count
              ,sum(invoice_amount) as invoice_total
          from public.invoices i
          inner join sunat.type_invoices ti on (
              ti.typeinvoice_code = i.invoice_type
              and ti.status is true
              and ti.typeinvoice_code in ('01','03')
          )
          where i.status is true
          and i.invoice_status = 2
          and to_char(i.invoice_date_created, 'YYYY') = :year
          group by 
              to_char(i.invoice_date_created, 'YYYY')
              ,to_char(i.invoice_date_created, 'MM')
              ,to_char(i.invoice_date_created, 'DD')
      ) as report;
      ";

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":year", $year, PDO::PARAM_STR);

    return $command->queryRow();
  }

  public static function getAllMonthByYear($year) {
    $sql = "
      select
          to_char(i.invoice_date_created, 'YYYY') as invoice_year
          ,to_char(i.invoice_date_created, 'MM') as invoice_month
          ,count(i.invoice_id) as invoice_count
          ,sum(invoice_amount) as invoice_total
      from public.invoices i
      inner join sunat.type_invoices ti on (
          ti.typeinvoice_code = i.invoice_type
          and ti.status is true
          and ti.typeinvoice_code in ('01','03')
      )
      where i.status is true
      and i.invoice_status = 2
      and to_char(i.invoice_date_created, 'YYYY') = :year
      group by 
          to_char(i.invoice_date_created, 'YYYY')
          ,to_char(i.invoice_date_created, 'MM');
      ";

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":year", $year, PDO::PARAM_STR);

    return $command->queryAll();
  }

  public static function getAllDayByYearAndMonth($year, $month) {
    $sql = "
      select
          to_char(i.invoice_date_created, 'YYYY') as invoice_year
          ,to_char(i.invoice_date_created, 'MM') as invoice_month
          ,to_char(i.invoice_date_created, 'DD') as invoice_day
          ,count(i.invoice_id) as invoice_count
          ,sum(invoice_amount) as invoice_total
      from public.invoices i
      inner join sunat.type_invoices ti on (
          ti.typeinvoice_code = i.invoice_type
          and ti.status is true
          and ti.typeinvoice_code in ('01','03')
      )
      where i.status is true
      and i.invoice_status = 2
      and to_char(i.invoice_date_created, 'YYYY') = :year
      and to_char(i.invoice_date_created, 'MM') = :month
      group by 
          to_char(i.invoice_date_created, 'YYYY')
          ,to_char(i.invoice_date_created, 'MM')
          ,to_char(i.invoice_date_created, 'DD')
      order by 3;
      ";

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":year", $year, PDO::PARAM_STR);
    $command->bindParam(":month", $month, PDO::PARAM_STR);

    return $command->queryAll();
  }

}
