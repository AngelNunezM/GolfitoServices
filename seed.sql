INSERT INTO roles (id, name, description)
VALUES
('11111111-1111-1111-1111-111111111111','Administrador','Gestiona la plataforma'),
('22222222-2222-2222-2222-222222222222','Gerente','Supervisa operaciones'),
('33333333-3333-3333-3333-333333333333','Mesero','Realiza actividades de servicio al cliente'),
('44444444-4444-4444-4444-444444444444','Cocinero','Realiza actividades de gestión de cocina'),
('55555555-5555-5555-5555-555555555555','Intendente','Realiza actividades de limpieza y mantenimiento'),
('77777777-7777-7777-7777-777777777777','Barman','Gestiona la barra de bebidas');

INSERT INTO pay_methods (id, name)
VALUES
('11111111-1111-1111-1111-111111111111','Efectivo'),
('22222222-2222-2222-2222-222222222222','Tarjeta de crédito/débito'),
('33333333-3333-3333-3333-333333333333','Transferencia bancaria'),
('44444444-4444-4444-4444-444444444444','PayPal'),
('55555555-5555-5555-5555-555555555555','Cheque');

INSERT INTO areas(id, name, is_active)
VALUES
('11111111-1111-1111-1111-111111111111','Cocina', 1),
('22222222-2222-2222-2222-222222222222','Barra', 1),
('33333333-3333-3333-3333-333333333333','Caja', 1),
('44444444-4444-4444-4444-444444444444','Limpieza', 1),
('55555555-5555-5555-5555-555555555555','Mesas', 1);

INSERT INTO units(id, name, abbreviation, is_active)
VALUES
('11111111-1111-1111-1111-111111111111','Unidad','u', 1),
('22222222-2222-2222-2222-222222222222','Litro','l', 1),
('33333333-3333-3333-3333-333333333333','Mililitro','ml', 1),
('44444444-4444-4444-4444-444444444444','Gramo','g', 1),
('55555555-5555-5555-5555-555555555555','Kilogramo','kg', 1),
('66666666-6666-6666-6666-666666666666','Metro','m', 1),
('77777777-7777-7777-7777-777777777777','Centímetro','cm', 1),
('88888888-8888-8888-8888-888888888888','Milímetro','mm', 1);