/**
	**Trigger para actualizar el stock de un articulo  despues de una compra
**/
DELIMITER //
CREATE TRIGGER tr_updStockIngreso AFTER INSERT ON detalle_ingreso
 FOR EACH ROW BEGIN
    UPDATE articulotalla SET stock=stock + NEW.cantidad
    WHERE articulotalla.id_articulo= NEW.idarticulo
    AND articulotalla.id_talla=NEW.idtalla;
 END
//
DELIMITER ;

/**
	**Trigger para actualizar el precio de un articulo despues de una compra
**/
DELIMITER //
CREATE TRIGGER tr_updPrecioVenta AFTER INSERT ON detalle_ingreso
 FOR EACH ROW BEGIN
    UPDATE articulo SET precio=NEW.precio_venta
    WHERE articulo.id= NEW.idarticulo;

 END
//
DELIMITER ;

/**
	**Trigger para actualizar el stock de un articulo despues de una venta
**/
DELIMITER //
CREATE TRIGGER tr_updStockVenta AFTER INSERT ON orderitems
 FOR EACH ROW BEGIN
    UPDATE articulotalla SET stock=stock - NEW.quantity
    WHERE articulotalla.id_articulo= NEW.articulo_id
    AND articulotalla.id_talla=NEW.id_talla;
 END
//
DELIMITER ;

/**Trigger para actualizar el stoc despues de anular una compra**/

DELIMITER //
CREATE TRIGGER tr_updStockAnularCompra AFTER UPDATE ON ingreso 
FOR EACH ROW BEGIN
    UPDATE articulo a
    JOIN detalle_ingreso di
    ON a.id=di.idarticulo
    JOIN articulotalla at
    ON at.id_articulo=a.id
    AND di.idtalla=at.id_talla
    AND di.idingreso=NEW.id
    SET at.stock=at.stock-di.cantidad;

END;
//
DELIMITER;
