USE [senacyt_asset]
GO
/****** Object:  Table [dbo].[Asset]    Script Date: 2016-07-29 오후 3:18:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Asset](
	[asset_id] [int] IDENTITY(1,1) NOT NULL,
	[asset_barcode] [varchar](50) NULL,
	[asset_desc] [varchar](50) NULL,
	[asset_brand] [varchar](20) NULL,
	[asset_model] [varchar](50) NULL,
	[asset_serial] [varchar](30) NULL,
	[asset_bought_date] [date] NULL,
	[asset_last_touch] [date] NULL,
	[asset_guarantee_expired] [date] NULL,
	[asset_out] [date] NULL,
	[asset_in] [date] NULL,
	[asset_price] [float] NULL,
	[loc_id] [int] NULL,
	[asset_provider] [varchar](20) NULL,
	[p_id] [int] NOT NULL,
	[pos] [int] NULL,
	[t_id] [int] NULL,
	[asset_details] [varchar](150) NULL,
PRIMARY KEY CLUSTERED 
(
	[asset_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Department]    Script Date: 2016-07-29 오후 3:18:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Department](
	[dept_id] [int] IDENTITY(1,1) NOT NULL,
	[dept_name] [varchar](20) NULL,
	[dept_location] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[dept_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Loc]    Script Date: 2016-07-29 오후 3:18:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Loc](
	[loc_id] [int] IDENTITY(1,1) NOT NULL,
	[loc_building] [varchar](20) NULL,
	[loc_floor] [varchar](20) NOT NULL,
	[loc_desc] [varchar](30) NULL,
PRIMARY KEY CLUSTERED 
(
	[loc_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[log_Asset]    Script Date: 2016-07-29 오후 3:18:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[log_Asset](
	[log_id] [int] IDENTITY(1,1) NOT NULL,
	[log_name] [varchar](20) NULL,
	[log_date] [datetime] NULL,
	[asset_id] [int] NULL,
	[asset_barcode] [varchar](50) NULL,
	[asset_desc] [varchar](50) NULL,
	[asset_brand] [varchar](20) NULL,
	[asset_model] [varchar](50) NULL,
	[asset_serial] [varchar](30) NULL,
	[asset_bought_date] [date] NULL,
	[asset_last_touch] [date] NULL,
	[asset_guarantee_expired] [date] NULL,
	[asset_out] [date] NULL,
	[asset_in] [date] NULL,
	[asset_price] [float] NULL,
	[loc_id] [int] NULL,
	[asset_provider] [varchar](20) NULL,
	[p_id] [int] NULL,
	[pos] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[log_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[log_Department]    Script Date: 2016-07-29 오후 3:18:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[log_Department](
	[log_id] [int] IDENTITY(1,1) NOT NULL,
	[log_name] [varchar](20) NULL,
	[log_date] [datetime] NULL,
	[dept_id] [int] NULL,
	[dept_name] [varchar](20) NULL,
	[dept_location] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[log_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[log_Loc]    Script Date: 2016-07-29 오후 3:18:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[log_Loc](
	[log_id] [int] IDENTITY(1,1) NOT NULL,
	[log_name] [varchar](20) NULL,
	[log_date] [datetime] NULL,
	[loc_id] [int] NULL,
	[loc_building] [varchar](20) NULL,
	[loc_floor] [varchar](20) NOT NULL,
	[loc_desc] [varchar](30) NULL,
PRIMARY KEY CLUSTERED 
(
	[log_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[log_Person]    Script Date: 2016-07-29 오후 3:18:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[log_Person](
	[log_id] [int] IDENTITY(1,1) NOT NULL,
	[log_name] [varchar](20) NULL,
	[log_date] [datetime] NULL,
	[p_id] [int] NULL,
	[p_name] [varchar](20) NULL,
	[dept_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[log_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Person]    Script Date: 2016-07-29 오후 3:18:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Person](
	[p_id] [int] IDENTITY(1,1) NOT NULL,
	[p_name] [varchar](20) NULL,
	[dept_id] [int] NULL,
	[p_lastname] [varchar](30) NULL,
PRIMARY KEY CLUSTERED 
(
	[p_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tipo]    Script Date: 2016-07-29 오후 3:18:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tipo](
	[t_id] [int] IDENTITY(1,1) NOT NULL,
	[t_name] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[t_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Asset] ADD  DEFAULT ((1)) FOR [pos]
GO
ALTER TABLE [dbo].[Asset]  WITH CHECK ADD  CONSTRAINT [df] FOREIGN KEY([p_id])
REFERENCES [dbo].[Person] ([p_id])
GO
ALTER TABLE [dbo].[Asset] CHECK CONSTRAINT [df]
GO
ALTER TABLE [dbo].[Asset]  WITH CHECK ADD FOREIGN KEY([loc_id])
REFERENCES [dbo].[Loc] ([loc_id])
GO
ALTER TABLE [dbo].[Asset]  WITH CHECK ADD  CONSTRAINT [fk_asset_tipo] FOREIGN KEY([t_id])
REFERENCES [dbo].[tipo] ([t_id])
GO
ALTER TABLE [dbo].[Asset] CHECK CONSTRAINT [fk_asset_tipo]
GO
ALTER TABLE [dbo].[log_Asset]  WITH CHECK ADD FOREIGN KEY([loc_id])
REFERENCES [dbo].[Loc] ([loc_id])
GO
ALTER TABLE [dbo].[log_Asset]  WITH CHECK ADD FOREIGN KEY([p_id])
REFERENCES [dbo].[Person] ([p_id])
GO
ALTER TABLE [dbo].[log_Person]  WITH CHECK ADD FOREIGN KEY([dept_id])
REFERENCES [dbo].[Department] ([dept_id])
GO
ALTER TABLE [dbo].[Person]  WITH CHECK ADD FOREIGN KEY([dept_id])
REFERENCES [dbo].[Department] ([dept_id])
GO
