USE [FAM_V3]
GO
/****** Object:  UserDefinedFunction [dbo].[xfn_ASAL]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Yaqub
-- Create date: 2018-08-31
-- Description:	total jumlah butget asal
-- =============================================
CREATE FUNCTION [dbo].[xfn_ASAL]
(
	-- Add the parameters for the function here
	@DivisionID VARCHAR(50),
	@YEAR VARCHAR(4)
)
	RETURNS VARCHAR(100)
	AS
	BEGIN

		DECLARE @Return FLOAT=(
		
		SELECT sum(TF.JUMLAH) as JUMLAH 
		FROM [dbo].[TBL_T_TRANSFER_BUDGET] AS TF
		WHERE TF.BRANCH_DIV_ASAL=@DivisionID
			AND YEAR(TF.TANGGAL)=@YEAR
		group by YEAR(TF.TANGGAL),TF.BRANCH_DIV_ASAL
		)

		RETURN ISNULL(@Return,0)
	END

GO
/****** Object:  UserDefinedFunction [dbo].[xfn_Booking]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		Yaqub
-- Create date: 2018-08-31
-- Description:	total jumlah butget asal
-- =============================================
CREATE FUNCTION [dbo].[xfn_Booking]
(
	-- Add the parameters for the function here
	@TAHUN VARCHAR(4),
	@BranchID VARCHAR(50),
	@DivisionID VARCHAR(50),
	@JnsBudget VARCHAR(50)
)
	RETURNS VARCHAR(100)
	AS
	BEGIN

		DECLARE @Return FLOAT=(
		
		SELECT sum(T.Budget_Booking) as Budget_Booking
		FROM [dbo].[TBL_T_TRANS] AS T
		WHERE T.Tahun=@TAHUN
			AND T.BranchID=@BranchID
			AND T.DivisionID=@DivisionID
			AND T.Jenis_budget=@JnsBudget
		group by T.Tahun,T.BranchID,T.DivisionID,T.Jenis_budget
		)

		RETURN ISNULL(@Return,0)
	END


GO
/****** Object:  UserDefinedFunction [dbo].[xfn_Booking_kembali]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


-- =============================================
-- Author:		Yaqub
-- Create date: 2018-08-31
-- Description:	total jumlah butget asal
-- =============================================
CREATE FUNCTION [dbo].[xfn_Booking_kembali]
(
	-- Add the parameters for the function here
	@TAHUN VARCHAR(4),
	@BranchID VARCHAR(50),
	@DivisionID VARCHAR(50),
	@JnsBudget VARCHAR(50)
)
	RETURNS VARCHAR(100)
	AS
	BEGIN

		DECLARE @Return FLOAT=(
		
		SELECT sum(T.Kembalian) as Budget_Booking
		FROM [dbo].[TBL_T_TRANS] AS T
		WHERE T.Tahun=@TAHUN
			AND T.BranchID=@BranchID
			AND T.DivisionID=@DivisionID
			AND T.Jenis_budget=@JnsBudget
		group by T.Tahun,T.BranchID,T.DivisionID,T.Jenis_budget
		)

		RETURN ISNULL(@Return,0)
	END



GO
/****** Object:  UserDefinedFunction [dbo].[xfn_TUJUAN]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		Yaqub
-- Create date: 2018-08-31
-- Description:	total jumlah butget TUJUAN
-- =============================================
CREATE FUNCTION [dbo].[xfn_TUJUAN]
(
	-- Add the parameters for the function here
	@DivisionID VARCHAR(50),
	@YEAR VARCHAR(4)
)
	RETURNS VARCHAR(100)
	AS
	BEGIN

		DECLARE @Return FLOAT=(
		
		SELECT sum(TF.JUMLAH) as JUMLAH 
		FROM [dbo].[TBL_T_TRANSFER_BUDGET] AS TF
		WHERE TF.BRANCH_DIV_TUJUAN=@DivisionID
			AND YEAR(TF.TANGGAL)=@YEAR
		group by YEAR(TF.TANGGAL),TF.BRANCH_DIV_TUJUAN
		)

		RETURN ISNULL(@Return,0)
	END


GO
/****** Object:  Table [dbo].[Appv_List]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Appv_List](
	[AppvCategoryID] [nchar](10) NULL,
	[AppvID] [bigint] IDENTITY(1,1) NOT NULL,
	[PositionID] [nchar](10) NULL,
	[ApprovalLevel] [int] NOT NULL,
	[Alternate] [nchar](10) NULL,
	[Place] [nchar](10) NULL,
	[Status] [int] NOT NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Appv_List_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_ListOfAppv] PRIMARY KEY CLUSTERED 
(
	[AppvID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Appv_ListCategory]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Appv_ListCategory](
	[AppvCategoryID] [bigint] IDENTITY(1,1) NOT NULL,
	[AppvCategoryMin] [bigint] NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst__ListAppCategory_Is_trash]  DEFAULT ((0)),
	[AppvCategoryMax] [bigint] NULL CONSTRAINT [DF__Appv_List__AppvC__30592A6F]  DEFAULT (NULL)
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Appv_Request]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Appv_Request](
	[ReqAppvID] [bigint] IDENTITY(1,1) NOT NULL,
	[RequestID] [nvarchar](50) NOT NULL,
	[AppvID] [nchar](10) NULL,
	[PositionID] [nchar](10) NULL,
	[AppvStatus] [int] NULL,
	[Note] [varchar](160) NULL,
	[AppvDate] [datetime] NULL,
	[AppvBy] [nchar](10) NULL,
	[StatusNotif] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Appv_Request_Is_trash]  DEFAULT ((0)),
	[Vendor_win] [varchar](50) NULL,
 CONSTRAINT [PK_Appv_Request] PRIMARY KEY CLUSTERED 
(
	[ReqAppvID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[breeder_category]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[breeder_category](
	[category_id] [int] NOT NULL,
	[category_name] [varchar](50) NOT NULL,
	[create_date] [datetime2](0) NOT NULL,
	[is_trash] [int] NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Depreciation]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Depreciation](
	[DepreciationID] [bigint] IDENTITY(1,1) NOT NULL,
	[TrxDetItemID] [nvarchar](50) NOT NULL,
	[Date] [date] NULL,
	[Value] [float] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[master_dept]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[master_dept](
	[id_dept] [char](6) NOT NULL,
	[nama_dept] [varchar](250) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_dept] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[master_karyawan]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[master_karyawan](
	[id_kyw] [char](6) NOT NULL,
	[nama_kyw] [char](50) NULL,
	[dept_kyw] [char](50) NULL,
	[nama_akun_bank] [char](50) NULL,
	[no_akun_bank] [char](50) NULL,
	[nama_bank] [char](50) NULL,
	[kode_perk] [char](50) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[menu]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[menu](
	[id] [int] NOT NULL,
	[menu_name] [varchar](255) NOT NULL,
	[id_menugroup] [int] NOT NULL,
	[controller_name] [varchar](255) NOT NULL,
	[link] [varchar](50) NOT NULL,
	[description] [varchar](255) NOT NULL,
	[by_order] [int] NULL,
	[is_trash] [int] NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[menu_group]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[menu_group](
	[id_menugroup] [int] NOT NULL,
	[menugroup_name] [varchar](50) NOT NULL,
	[link] [varchar](30) NOT NULL,
	[icon] [varchar](50) NOT NULL,
	[create_date] [date] NOT NULL,
	[update_date] [date] NOT NULL,
	[is_trash] [int] NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[menu_hakaccess]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[menu_hakaccess](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_menugroup] [int] NOT NULL,
	[menu_id] [int] NOT NULL,
	[usergroup_id] [int] NOT NULL,
	[is_menu] [int] NOT NULL,
	[is_view] [int] NULL DEFAULT (NULL),
	[is_add] [int] NULL DEFAULT (NULL),
	[is_update] [int] NULL DEFAULT (NULL),
	[is_delete] [int] NULL DEFAULT (NULL)
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[menu_hakaccess_menugroup]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[menu_hakaccess_menugroup](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[grp_id] [int] NOT NULL,
	[usergroup_id] [int] NOT NULL,
	[is_menu] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Access]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Access](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[AccessID] [nvarchar](10) NOT NULL,
	[AccessName] [nvarchar](50) NOT NULL,
	[Status] [int] NOT NULL,
 CONSTRAINT [PK_Mst_Access] PRIMARY KEY CLUSTERED 
(
	[AccessID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_BisUnit]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_BisUnit](
	[BisUnitID] [bigint] IDENTITY(1,1) NOT NULL,
	[BisUnitCode] [nvarchar](10) NULL,
	[BisUnitName] [nvarchar](80) NOT NULL,
	[BisUnitBranchID] [nvarchar](50) NOT NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL CONSTRAINT [DF_Mst_BisUnit_CreateBy]  DEFAULT ((10)),
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_BisUnit_Is_trash]  DEFAULT ((0)),
	[UnitAlias] [nchar](15) NULL,
 CONSTRAINT [PK_Mst_BisUnit] PRIMARY KEY CLUSTERED 
(
	[BisUnitID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Branch]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Branch](
	[BranchID] [bigint] IDENTITY(1,1) NOT NULL,
	[BranchCode] [nchar](10) NULL,
	[BranchName] [nvarchar](80) NOT NULL,
	[BranchAlias] [nvarchar](10) NULL,
	[ZoneID] [nvarchar](10) NOT NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Branch_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Branch] PRIMARY KEY CLUSTERED 
(
	[BranchID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Budget]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Budget](
	[BudgetID] [bigint] IDENTITY(1,1) NOT NULL,
	[BisUnitID] [nvarchar](10) NULL,
	[BudgetCOA] [nvarchar](80) NOT NULL,
	[Year] [nchar](10) NOT NULL,
	[BranchID] [nchar](10) NULL,
	[DivisionID] [nchar](10) NULL,
	[BudgetOwnID] [nvarchar](10) NOT NULL,
	[BudgetValue] [float] NOT NULL,
	[BudgetUsed] [float] NOT NULL,
	[Jenis_budget] [bigint] NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Budget_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Budget] PRIMARY KEY CLUSTERED 
(
	[BudgetID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_BudgetOpex]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_BudgetOpex](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[BudgetIdOpex] [nchar](10) NULL,
	[BudgetValueOpex] [float] NULL CONSTRAINT [DF_Mst_BudgetOpex_BudgetValueOpex]  DEFAULT ((0)),
	[BudgetNewOpex] [float] NULL CONSTRAINT [DF_Mst_BudgetOpex_BudgetNewOpex]  DEFAULT ((0)),
	[YearOpex] [nchar](10) NULL,
	[Status] [int] NULL CONSTRAINT [DF_Mst_BudgetOpex_Status]  DEFAULT ((0)),
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_BudgetOpex_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_BudgetOpex] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_BudgetOpexDetail]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_BudgetOpexDetail](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[BudgetIdOpex] [nchar](10) NULL,
	[BudgetOpexDetail] [nchar](20) NULL,
	[BudgetUsedOpex] [float] NULL,
	[BranchID] [nchar](10) NULL,
	[DivisionID] [nchar](10) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_BudgetOpexDetail_Is_trash]  DEFAULT ((0)),
	[YearOpexDetail] [nchar](10) NULL,
 CONSTRAINT [PK_Mst_BudgetOpexDetail] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_BudgetType]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_BudgetType](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[BudgetTypeID] [nvarchar](10) NOT NULL,
	[BudgetType] [nvarchar](50) NOT NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NOT NULL,
 CONSTRAINT [PK_Mst_BudgetType] PRIMARY KEY CLUSTERED 
(
	[BudgetTypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Company]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Company](
	[IdCompany] [nvarchar](3) NOT NULL,
	[NamaCompany] [nvarchar](50) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Company_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Company] PRIMARY KEY CLUSTERED 
(
	[IdCompany] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Departement]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Departement](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[DivisionID] [nvarchar](10) NOT NULL,
	[DeptID] [nvarchar](10) NOT NULL,
	[DeptName] [nvarchar](50) NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NOT NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Division]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Mst_Division](
	[BranchID] [varchar](10) NOT NULL,
	[DivisionID] [bigint] IDENTITY(1,1) NOT NULL,
	[DivisionCode] [nvarchar](15) NULL,
	[DivisionName] [varchar](200) NOT NULL,
	[DivisionAlias] [nvarchar](50) NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Division_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Division] PRIMARY KEY CLUSTERED 
(
	[DivisionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Mst_Employee]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Mst_Employee](
	[EmployeeID] [bigint] NOT NULL,
	[IdSdm] [nvarchar](50) NULL,
	[Nik] [nvarchar](50) NULL,
	[EmployeeName] [nvarchar](80) NULL,
	[EmployeeEmail] [nvarchar](50) NULL,
	[ZoneID] [nvarchar](10) NULL,
	[BranchID] [bigint] NULL,
	[BisUnitID] [nvarchar](10) NULL,
	[DivisionID] [varchar](10) NULL,
	[DepartmentID] [nvarchar](20) NULL,
	[PositionID] [nchar](10) NULL,
	[Location] [nvarchar](50) NULL,
	[AccessLevel] [nvarchar](10) NULL,
	[Status] [int] NULL,
	[user_groupid] [int] NULL,
	[User_groupName] [nvarchar](20) NULL,
	[image] [varchar](250) NULL,
	[IdCompany] [nvarchar](3) NULL,
 CONSTRAINT [PK_Mst_Employee] PRIMARY KEY CLUSTERED 
(
	[EmployeeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Mst_HPS]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_HPS](
	[HpsID] [bigint] IDENTITY(1,1) NOT NULL,
	[ItemID] [nvarchar](50) NOT NULL,
	[ZoneID] [nvarchar](10) NOT NULL,
	[StartDate] [datetime] NULL,
	[EndDate] [datetime] NULL,
	[BranchID] [nchar](10) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF__Mst_HPS__Is_tras__5C6CB6D7]  DEFAULT ('0'),
	[Price] [nchar](50) NOT NULL CONSTRAINT [DF__Mst_HPS__Price__02925FBF]  DEFAULT ('0'),
 CONSTRAINT [PK__Mst_HPS__285EAA96A0746233] PRIMARY KEY CLUSTERED 
(
	[HpsID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_HpsHistory]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_HpsHistory](
	[RAW_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[HpsID] [bigint] NOT NULL,
	[ItemID] [nvarchar](50) NOT NULL,
	[ZoneID] [nvarchar](10) NOT NULL,
	[StartDate] [datetime] NULL,
	[EndDate] [datetime] NULL,
	[BranchID] [nchar](10) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL,
	[Price] [nchar](50) NOT NULL,
 CONSTRAINT [PK_Mst_HpsHistory] PRIMARY KEY CLUSTERED 
(
	[RAW_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_ItemClass]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_ItemClass](
	[IClassID] [bigint] IDENTITY(1,1) NOT NULL,
	[ClassCode] [nchar](5) NULL,
	[IClassName] [nvarchar](50) NOT NULL,
	[Priod] [nchar](10) NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_ItemClass_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_ItemClass] PRIMARY KEY CLUSTERED 
(
	[IClassID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_ItemList]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Mst_ItemList](
	[IClassID] [bigint] NOT NULL,
	[ItemTypeID] [bigint] NOT NULL,
	[ItemID] [bigint] IDENTITY(1,1) NOT NULL,
	[ItemName] [nvarchar](500) NOT NULL,
	[Image] [nvarchar](200) NOT NULL,
	[VendorID] [nvarchar](10) NOT NULL,
	[Status] [int] NOT NULL,
	[StatusMadya] [int] NULL,
	[StatusPratama] [int] NULL,
	[StatusUtama] [nchar](10) NULL,
	[StatusMekar] [int] NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_ItemList_Is_trash]  DEFAULT ((0)),
	[AssetType] [varchar](20) NULL,
 CONSTRAINT [PK_Mst_ItemList] PRIMARY KEY CLUSTERED 
(
	[ItemID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Mst_ItemListAP]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Mst_ItemListAP](
	[IClassID] [bigint] NOT NULL,
	[ItemTypeID] [bigint] NOT NULL,
	[ItemID] [bigint] IDENTITY(1,1) NOT NULL,
	[ItemName] [nvarchar](80) NOT NULL,
	[Image] [nvarchar](200) NOT NULL,
	[VendorID] [nvarchar](10) NOT NULL,
	[Status] [int] NOT NULL,
	[StatusMadya] [int] NULL,
	[StatusPratama] [int] NULL,
	[StatusUtama] [nchar](10) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_ItemListAP_Is_trash]  DEFAULT ((0)),
	[AssetType] [varchar](20) NULL,
	[Tnh_KodeAset] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_KodeAset]  DEFAULT (N'-'),
	[Tnh_Alamat] [nvarchar](255) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Alamat]  DEFAULT (N'-'),
	[Tnh_Kelurahan] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Kelurahan]  DEFAULT (N'-'),
	[Tnh_Kecamatan] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Kecamatan]  DEFAULT (N'-'),
	[Tnh_Kabupaten] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Kabupaten]  DEFAULT (N'-'),
	[Tnh_Provinsi] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Provinsi]  DEFAULT (N'-'),
	[Tnh_KdPos] [nvarchar](10) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_KdPos]  DEFAULT (N'-'),
	[Tnh_Status] [int] NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Status]  DEFAULT ((0)),
	[Tnh_LuasTnh] [numeric](18, 2) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_LuasTnh]  DEFAULT ((0)),
	[Tnh_TglMkpa] [datetime] NULL,
	[Tnh_NoMkpa] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_NoMkpa]  DEFAULT (N'-'),
	[Tnh_Wilayah] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Wilayah]  DEFAULT (N'-'),
	[Tnh_Tujuan] [nvarchar](100) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_Tujuan]  DEFAULT (N'-'),
	[Tnh_StatusMlk] [nvarchar](10) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_StatusMlk]  DEFAULT (N'-'),
	[Tnh_NoSurat] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_NoSurat]  DEFAULT (N'-'),
	[Tnh_NamaSurat] [nvarchar](100) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_NamaSurat]  DEFAULT (N'-'),
	[Tnh_TglSurat] [date] NULL,
	[Tnh_LuasBangunan] [decimal](18, 2) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_LuasBangunan]  DEFAULT ((0)),
	[Tnh_HargaBeli] [decimal](18, 2) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_HargaBeli]  DEFAULT ((0)),
	[Tnh_NilaiBuku] [decimal](18, 2) NULL CONSTRAINT [DF_Mst_ItemListAP_Tnh_NilaiBuku]  DEFAULT ((0)),
	[Id_Company] [nchar](10) NULL,
	[Knd_NoSPK] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoSPK]  DEFAULT (N'-'),
	[Knd_NoPSWADD] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoPSWADD]  DEFAULT (N'-'),
	[Knd_NoPSW] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoPSW]  DEFAULT (N'-'),
	[Knd_TglPSW] [date] NULL,
	[Knd_AkhrSewa] [date] NULL,
	[Knd_MasaSewa] [int] NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_MasaSewa]  DEFAULT ((0)),
	[Knd_AnSTNK] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_AnSTNK]  DEFAULT (N'-'),
	[Knd_NoPolisi] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoPolisi]  DEFAULT (N'-'),
	[Knd_NoPolisiFix] [nvarchar](50) NULL CONSTRAINT [DF__Mst_ItemL__Knd_N__6CD828CA]  DEFAULT (N'-'),
	[Knd_Merk] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_Merk]  DEFAULT (N'-'),
	[Knd_Type] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_Type]  DEFAULT (N'-'),
	[Knd_NoStnk] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoStnk]  DEFAULT (N'-'),
	[Knd_NoRangka] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoRangka]  DEFAULT (N'-'),
	[Knd_Mesin] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_Mesin]  DEFAULT (N'-'),
	[Knd_NoBPKB] [nvarchar](50) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_NoBPKB]  DEFAULT (N'-'),
	[Knd_PosisiBPKB] [nvarchar](100) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_PosisiBPKB]  DEFAULT (N'-'),
	[Knd_PosisiKendaraan] [nvarchar](100) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_PosisiKendaraan]  DEFAULT (N'-'),
	[Knd_ThnPmbtn] [nvarchar](10) NULL CONSTRAINT [DF_Mst_ItemListAP_Knd_ThnPmbtn]  DEFAULT (N'-'),
	[Gst_Desc] [text] NULL CONSTRAINT [DF_Mst_ItemListAP_Gst_Desc]  DEFAULT ('-'),
	[Gst_Pelaksana] [nvarchar](100) NULL CONSTRAINT [DF_Mst_ItemListAP_Gst_Pelaksana]  DEFAULT (N'-'),
	[Gst_SerialNumber] [nvarchar](100) NULL CONSTRAINT [DF_Mst_ItemListAP_Gst_SerialNumber]  DEFAULT (N'-'),
 CONSTRAINT [PK_Mst_ItemListAP] PRIMARY KEY CLUSTERED 
(
	[ItemID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Mst_ItemType]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_ItemType](
	[IClassID] [nchar](10) NULL,
	[ItemTypeID] [bigint] IDENTITY(1,1) NOT NULL,
	[TypeCode] [nchar](5) NULL,
	[ItemTypeName] [nvarchar](80) NOT NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_ItemType_Is_trash]  DEFAULT ((0)),
	[UpdateDate] [datetime] NULL,
 CONSTRAINT [PK_Mst_ItemType] PRIMARY KEY CLUSTERED 
(
	[ItemTypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Kabupaten]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Kabupaten](
	[IdKabupaten] [nvarchar](50) NOT NULL,
	[NamaKabupaten] [nvarchar](200) NULL,
 CONSTRAINT [PK_Mst_Kabupaten] PRIMARY KEY CLUSTERED 
(
	[IdKabupaten] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Kecamatan]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Kecamatan](
	[IdKecamatan] [nvarchar](50) NOT NULL,
	[NamaKecamatan] [nvarchar](250) NULL,
 CONSTRAINT [PK_Mst_Kecamatan] PRIMARY KEY CLUSTERED 
(
	[IdKecamatan] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Kelurahan]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Kelurahan](
	[IdKelurahan] [nvarchar](50) NOT NULL,
	[NamaKelurahan] [nvarchar](250) NULL,
 CONSTRAINT [PK_Mst_Kelurahan] PRIMARY KEY CLUSTERED 
(
	[IdKelurahan] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Password]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Password](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[EmployeeID] [nvarchar](50) NOT NULL,
	[Password] [nvarchar](20) NOT NULL,
	[CreatedDate] [datetime] NOT NULL,
	[Status] [int] NOT NULL,
 CONSTRAINT [PK_Mst_Password] PRIMARY KEY CLUSTERED 
(
	[EmployeeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Position]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Position](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[PositionID] [nchar](255) NOT NULL,
	[PositionName] [nvarchar](50) NULL,
	[Status] [int] NULL CONSTRAINT [DF_Mst_Position_Status]  DEFAULT ((0)),
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Position_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Position] PRIMARY KEY CLUSTERED 
(
	[PositionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Provinsi]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Provinsi](
	[IdProvinsi] [nvarchar](50) NOT NULL,
	[NamaProvinsi] [nvarchar](100) NULL,
 CONSTRAINT [PK_Mst_Provinsi] PRIMARY KEY CLUSTERED 
(
	[IdProvinsi] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Request]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Mst_Request](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[RequestID] [bigint] NOT NULL,
	[ReqCategoryID] [nchar](10) NULL,
	[ReqTypeID] [nchar](10) NULL,
	[RktID] [nchar](10) NULL,
	[RktZoneID] [nchar](10) NULL,
	[EmployeeID] [nchar](10) NULL,
	[PositionID] [nchar](10) NULL,
	[BisUnitID] [nchar](10) NULL,
	[DivisionID] [nchar](10) NULL,
	[DepartementID] [nchar](10) NULL,
	[ZoneID] [nchar](10) NULL,
	[BranchID] [nchar](10) NULL,
	[Eksekutor] [nchar](10) NULL,
	[BudgetCOA] [nchar](15) NULL,
	[MyBudget] [float] NULL,
	[SubTotalPrice] [float] NULL,
	[RestOfBudget] [float] NULL,
	[Status] [int] NULL CONSTRAINT [DF_Mst_Request_StatusVendor]  DEFAULT ((0)),
	[VendorID] [nchar](10) NULL,
	[EndDate] [date] NULL,
	[StartDate] [date] NULL,
	[PriodSewa] [int] NULL,
	[PriceVendor] [nvarchar](16) NULL,
	[PathFile] [nvarchar](50) NULL,
	[DatePO] [datetime] NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Request_Is_trash]  DEFAULT ((0)),
	[Jenis_periode_sewa] [int] NULL CONSTRAINT [DF_Mst_Request_Jenis_periode_sewa]  DEFAULT ((0)),
	[Jangka_waktu] [int] NULL CONSTRAINT [DF_Mst_Request_Jangka_waktu]  DEFAULT ((0)),
	[Termin_sewa] [int] NULL CONSTRAINT [DF_Mst_Request_Termin_sewa]  DEFAULT ((0)),
	[Keterangan_hapus] [text] NULL,
	[file_vendor] [varchar](100) NULL,
	[Jtempo_sewa] [int] NULL,
	[status_view] [int] NULL CONSTRAINT [DF_Mst_Request_status_view]  DEFAULT ('0'),
	[Is_Migrasi] [int] NULL CONSTRAINT [DF_Mst_Request_Is_Migrasi]  DEFAULT ((0)),
	[Direktory_PR] [text] NULL CONSTRAINT [DF_Mst_Request_Direktory_PR]  DEFAULT ('kosong'),
 CONSTRAINT [PK_Mst_Request] PRIMARY KEY CLUSTERED 
(
	[RequestID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Mst_RequestCategory]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_RequestCategory](
	[ReqCategoryID] [bigint] IDENTITY(1,1) NOT NULL,
	[ReqCategoryName] [nvarchar](80) NOT NULL,
	[ReqTypeID] [nchar](10) NULL,
	[BudgetID] [nchar](10) NULL,
	[BudgetCOA] [nchar](10) NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Project_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Project] PRIMARY KEY CLUSTERED 
(
	[ReqCategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_RequestCategoryDetail]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_RequestCategoryDetail](
	[ReqCatDetail_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ReqCategoryID] [nchar](10) NULL,
	[IClassID] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_RequestCategoryDetail_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_RequestCategoryDetail] PRIMARY KEY CLUSTERED 
(
	[ReqCatDetail_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_RequestTo]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_RequestTo](
	[ReqToID] [bigint] NOT NULL,
	[ReqToName] [nchar](20) NULL,
	[Is_trash] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_RequestType]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_RequestType](
	[ReqTypeID] [bigint] IDENTITY(1,1) NOT NULL,
	[ReqTypeName] [nchar](20) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_RequestCategory_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_RequestCategory] PRIMARY KEY CLUSTERED 
(
	[ReqTypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Rkt]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Rkt](
	[RktID] [bigint] IDENTITY(1,1) NOT NULL,
	[RktName] [nvarchar](150) NULL,
	[RktYear] [nchar](20) NULL,
	[ReqCategoryID] [nchar](10) NULL,
	[BranchID] [nchar](10) NULL,
	[UnitID] [nchar](10) NULL,
	[DivisionID] [nchar](10) NULL,
	[ZoneID] [nchar](10) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Project_Is_trash_1]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Project_1] PRIMARY KEY CLUSTERED 
(
	[RktID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Vendor]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Vendor](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[VendorTypeID] [nchar](50) NOT NULL,
	[VendorID] [nchar](50) NOT NULL,
	[VendorName] [nvarchar](80) NOT NULL,
	[VendorAddress] [nvarchar](150) NULL,
	[NoTlp] [nchar](50) NULL,
	[NoRekening] [nchar](50) NULL,
	[JoinDate] [datetime] NOT NULL,
	[Performance] [int] NOT NULL,
	[Status] [int] NOT NULL,
	[Email] [nvarchar](50) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NOT NULL CONSTRAINT [DF_Mst_Vendor_Is_trash]  DEFAULT ((0)),
	[bank] [nvarchar](50) NULL,
	[Location] [nvarchar](100) NULL,
 CONSTRAINT [PK_Mst_Vendor] PRIMARY KEY CLUSTERED 
(
	[VendorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_VendorLogin]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_VendorLogin](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[VedorID] [nvarchar](10) NOT NULL,
	[Password] [nvarchar](50) NOT NULL,
	[LastLogin] [datetime] NOT NULL,
	[NewLogin] [datetime] NOT NULL,
	[Status] [int] NOT NULL,
 CONSTRAINT [PK_Mst_VendorLogin] PRIMARY KEY CLUSTERED 
(
	[VedorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_VendorType]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_VendorType](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[VendorTypeID] [nvarchar](10) NOT NULL,
	[VendorTypeName] [nvarchar](50) NOT NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_VendorType_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_VendorType] PRIMARY KEY CLUSTERED 
(
	[VendorTypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Mst_Zonasi]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Mst_Zonasi](
	[Raw_ID] [bigint] NOT NULL,
	[ZoneID] [bigint] IDENTITY(1,1) NOT NULL,
	[ZoneName] [nvarchar](50) NOT NULL,
	[Status] [int] NOT NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [int] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Mst_Zonasi_Is_trash]  DEFAULT ((0)),
 CONSTRAINT [PK_Mst_Zonasi] PRIMARY KEY CLUSTERED 
(
	[ZoneID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Pay_IAS]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Pay_IAS](
	[IasID] [bigint] IDENTITY(1,1) NOT NULL,
	[ListDocIas] [varchar](100) NULL,
	[Nomor] [nchar](500) NULL,
	[Date] [nvarchar](20) NULL,
	[RequestID] [nchar](10) NULL,
	[TerminID] [nchar](10) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Pay_Termin]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Pay_Termin](
	[TerminID] [bigint] IDENTITY(1,1) NOT NULL,
	[RequestID] [nchar](10) NULL,
	[VendorID] [nchar](10) NULL,
	[Step] [nchar](10) NULL,
	[WorkProgress] [float] NULL,
	[Achevment] [nchar](10) NULL,
	[WorkPayment] [float] NULL,
	[DatePayment] [varchar](50) NULL,
	[StatusPayment] [int] NULL CONSTRAINT [DF_Pay_Termin_StatusPayment]  DEFAULT ((0)),
	[DatePayment_termin] [datetime] NULL,
	[File_PaymentReceipt] [varchar](50) NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[NotifStatus] [int] NULL CONSTRAINT [DF_Pay_Termin_NotifStatus]  DEFAULT ((0)),
	[Status_Ias] [int] NULL CONSTRAINT [DF_Pay_Termin_Status_Ias]  DEFAULT ((0)),
	[Keterangan_Ias_old] [varchar](max) NULL,
	[Keterangan_Ias] [varchar](255) NULL,
	[Date_Payment_IAS] [datetime] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[sec_gol_user]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[sec_gol_user](
	[goluser_id] [varchar](6) NOT NULL,
	[goluser_desc] [varchar](25) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[sec_menu]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[sec_menu](
	[menu_id] [int] NOT NULL,
	[menu_nama] [varchar](250) NOT NULL,
	[menu_uri] [varchar](250) NOT NULL,
	[menu_header] [varchar](250) NOT NULL,
	[menu_allowed] [varchar](100) NOT NULL,
	[menu_seq] [int] NOT NULL,
	[parent] [int] NULL,
	[lvl] [smallint] NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[sec_passwd]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[sec_passwd](
	[userid] [smallint] NOT NULL,
	[username] [char](20) NOT NULL,
	[id_kyw] [char](6) NOT NULL,
	[password] [char](40) NOT NULL,
	[status_password] [smallint] NULL,
	[tgl_password] [date] NOT NULL,
	[usergroup] [char](2) NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[sec_status_user]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[sec_status_user](
	[statususer_id] [smallint] NOT NULL,
	[statususer_desc] [char](25) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[sec_usergroup]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[sec_usergroup](
	[usergroup_id] [char](2) NOT NULL,
	[usergroup_desc] [varchar](250) NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TBL_R_JNS_BUDGET]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TBL_R_JNS_BUDGET](
	[ID_JNS_BUDGET] [int] NOT NULL,
	[BUDGET_DESC] [varchar](50) NULL,
 CONSTRAINT [PK_TBL_R_JNS_BUDGET] PRIMARY KEY CLUSTERED 
(
	[ID_JNS_BUDGET] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TBL_T_SETTING_BUDGET]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TBL_T_SETTING_BUDGET](
	[ID_SETTTING_BUDGET] [bigint] IDENTITY(1,1) NOT NULL,
	[TAHUN] [char](4) NULL,
	[ID_JNS_BUDGET] [int] NULL,
	[STATUS] [int] NULL,
 CONSTRAINT [PK_TBL_T_SETTING_BUDGET] PRIMARY KEY CLUSTERED 
(
	[ID_SETTTING_BUDGET] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TBL_T_TRANS]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TBL_T_TRANS](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Tahun] [char](4) NULL,
	[BranchID] [varchar](10) NULL,
	[DivisionID] [varchar](10) NULL,
	[Jenis_budget] [varchar](10) NULL,
	[Budget_Booking] [float] NULL CONSTRAINT [DF_TBL_T_TRANS_Budget_Booking]  DEFAULT ((0)),
	[Kembalian] [float] NULL CONSTRAINT [DF_TBL_T_TRANS_Kembalian]  DEFAULT ((0)),
 CONSTRAINT [PK_TBL_T_TRANS] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TBL_T_TRANSFER_BUDGET]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TBL_T_TRANSFER_BUDGET](
	[ID_TB] [bigint] IDENTITY(1,1) NOT NULL,
	[TANGGAL] [date] NULL,
	[NAMA] [varchar](50) NULL,
	[POSISI] [varchar](50) NULL,
	[BRANCH_DIV_ASAL] [int] NULL,
	[BRANCH_DIV_TUJUAN] [int] NULL,
	[JUMLAH] [float] NULL,
	[CREATE_BY] [varchar](50) NULL,
	[CREATE_DATE] [datetime] NULL,
 CONSTRAINT [PK_TBL_T_TRANSFER_BUDGET] PRIMARY KEY CLUSTERED 
(
	[ID_TB] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Test]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Test](
	[BranchID] [float] NULL,
	[DivisionID] [float] NULL,
	[DivisionCode] [nvarchar](255) NULL,
	[DivisionName] [nvarchar](255) NULL,
	[DivisionAlias] [nvarchar](255) NULL,
	[Status] [float] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Trx_DetItemReq]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Trx_DetItemReq](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[TrxDetItemID] [int] NULL,
	[RequestID] [nvarchar](50) NULL,
	[ItemID] [nvarchar](10) NULL,
	[QTY] [int] NULL,
	[Price] [float] NULL,
	[PriceVendor] [float] NULL CONSTRAINT [DF_Trx_DetItemReq_PriceVendor]  DEFAULT ((0)),
	[Status] [int] NULL,
	[StatusAdditional] [int] NULL CONSTRAINT [DF_Trx_DetItemReq_StatusAdditional]  DEFAULT ((0)),
	[StatusLelang] [int] NULL CONSTRAINT [DF_Trx_DetItemReq_StatusLelang]  DEFAULT ((0)),
	[DateLelang] [datetime] NULL,
	[DateMutation] [datetime] NULL,
	[FAID] [varchar](20) NULL,
	[Period] [int] NULL,
	[Depreciation] [float] NULL,
	[SetDatePayment] [nvarchar](50) NULL,
	[Condition] [int] NULL CONSTRAINT [DF_Trx_DetItemReq_Condition]  DEFAULT ((1)),
	[CreateDate] [datetime] NULL,
	[CreateBy] [int] NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [int] NULL,
	[DeleteDate] [datetime] NULL,
	[Is_trash] [int] NULL CONSTRAINT [DF_Trx_DetItemReq_Is_trash]  DEFAULT ((0)),
	[Is_header] [int] NULL,
	[Parent] [bigint] NULL,
	[FAID_lama] [varchar](25) NULL CONSTRAINT [DF_Trx_DetItemReq_FAID_lama]  DEFAULT ('-'),
	[DateCondition] [datetime] NULL,
	[Image] [varchar](255) NULL,
	[Keterangan] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Trx_Hps]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Trx_Hps](
	[HpsID] [bigint] NOT NULL,
	[ItemID] [nchar](10) NULL,
	[ZonasiID] [nchar](10) NULL,
	[Date] [date] NULL,
	[Price] [money] NULL,
	[CreateDate] [datetime] NULL,
	[CreateBy] [nchar](10) NULL,
	[UpdateDate] [datetime] NULL,
	[UpdateBy] [nchar](10) NULL,
	[DeleteDate] [datetime] NULL,
	[DeleteBy] [nchar](10) NULL,
	[Is_trash] [int] NULL,
 CONSTRAINT [PK_Trx_Hps] PRIMARY KEY CLUSTERED 
(
	[HpsID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Trx_LoginStatus]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Trx_LoginStatus](
	[Raw_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[EmployeeID] [nvarchar](50) NOT NULL,
	[LastLogin] [datetime] NOT NULL,
	[NewLogin] [datetime] NOT NULL,
	[Status] [int] NOT NULL,
 CONSTRAINT [PK_Trx_LoginStatus] PRIMARY KEY CLUSTERED 
(
	[EmployeeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[user]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[user](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[idsdm] [varchar](60) NOT NULL,
	[nik] [varchar](15) NOT NULL,
	[user_name] [varchar](50) NOT NULL,
	[name] [varchar](50) NOT NULL,
	[PositionID] [varchar](10) NOT NULL,
	[BranchID] [varchar](10) NOT NULL,
	[ZoneID] [varchar](10) NOT NULL,
	[DivisionID] [int] NOT NULL,
	[user_email] [varchar](30) NOT NULL,
	[user_password] [varchar](225) NULL,
	[user_photo] [varchar](255) NULL,
	[JointDate] [datetime] NULL,
	[update_date] [datetime] NULL CONSTRAINT [DF__user__update_dat__2DE6D218]  DEFAULT (NULL),
	[user_last_login] [datetime] NULL CONSTRAINT [DF__user__user_last___2EDAF651]  DEFAULT (NULL),
	[status] [int] NOT NULL,
	[user_groupid] [int] NOT NULL,
	[is_trash] [int] NOT NULL CONSTRAINT [DF__user__is_trash__2FCF1A8A]  DEFAULT ((0)),
	[IdCompany] [nvarchar](3) NULL,
 CONSTRAINT [PK__user__B9BE370F0568A6EC] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[user_group]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[user_group](
	[id] [int] NOT NULL,
	[group_name] [varchar](100) NOT NULL CONSTRAINT [DF__user_grou__group__4D5F7D71]  DEFAULT ('0'),
	[group_desc] [varchar](255) NOT NULL CONSTRAINT [DF__user_grou__group__4E53A1AA]  DEFAULT (''),
	[create_date] [datetime] NOT NULL CONSTRAINT [DF__user_grou__creat__4F47C5E3]  DEFAULT (getdate()),
	[create_by] [varchar](30) NULL CONSTRAINT [DF__user_grou__creat__503BEA1C]  DEFAULT (NULL),
	[update_date] [datetime] NOT NULL CONSTRAINT [DF_user_group_update_date]  DEFAULT (getdate()),
	[update_by] [varchar](30) NULL CONSTRAINT [DF__user_grou__updat__51300E55]  DEFAULT (NULL),
	[trash_date] [datetime] NOT NULL CONSTRAINT [DF_user_group_trash_date]  DEFAULT (getdate()),
	[trash_by] [varchar](30) NULL CONSTRAINT [DF__user_grou__trash__5224328E]  DEFAULT (NULL),
	[is_trash] [varchar](1) NOT NULL CONSTRAINT [DF__user_grou__is_tr__531856C7]  DEFAULT ('0'),
 CONSTRAINT [PK__user_gro__3213E83F01E7F098] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[UserOnline]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[UserOnline](
	[UserOnlineID] [int] IDENTITY(1,1) NOT NULL,
	[EmployeeID] [varchar](50) NOT NULL,
	[Nama] [varchar](50) NOT NULL,
	[TglOnline] [varchar](50) NOT NULL,
	[Status] [varchar](5) NULL,
	[Photo] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[UserOnlineID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[web_log]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[web_log](
	[id_log] [char](20) NOT NULL,
	[waktu] [datetime2](6) NULL,
	[user_id] [char](10) NULL,
	[menu_id] [bigint] NULL,
	[action] [char](20) NULL,
	[keterangan] [varchar](200) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_log] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[web_sysid]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[web_sysid](
	[id_sysid] [int] NOT NULL,
	[keyname] [char](80) NOT NULL,
	[value] [char](200) NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  View [dbo].[vw_asset_mutation]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[vw_asset_mutation]
AS
SELECT  
newid() pid,      
item.ItemName, 
zone.ZoneName, 
br.BranchName, 
br.BranchCode, 
div.DivisionName, 
trx.QTY, 
trx.Raw_ID, 
trx.FAID, 
trx.Period, 
dep.Value, 
dep.Value as Value1, 
trx.PriceVendor, 
trx.SetDatePayment, 
trx.Condition, 
bis.BisUnitName, 
dep.Date,
zone.ZoneID,
div.DivisionID,
br.BranchID
FROM            dbo.Trx_DetItemReq AS trx INNER JOIN
                         dbo.Mst_ItemList AS item ON trx.ItemID = item.ItemID INNER JOIN
                         dbo.Mst_Request AS req ON trx.RequestID = req.RequestID INNER JOIN
                         dbo.Mst_Branch AS br ON req.BranchID = br.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS div ON req.DivisionID = div.DivisionID INNER JOIN
                         dbo.Mst_Zonasi AS zone ON req.ZoneID = zone.ZoneID LEFT OUTER JOIN
                         dbo.Mst_BisUnit AS bis ON SUBSTRING(trx.FAID, 12, 5) = bis.BisUnitCode LEFT OUTER JOIN
                         dbo.Depreciation AS dep ON trx.FAID = dep.TrxDetItemID
WHERE        (trx.Is_trash = 0) AND (trx.Status = 3) AND (trx.StatusLelang = 0) AND (item.AssetType = 'CAPEX')



GO
/****** Object:  View [dbo].[vw_asset_mutation2]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vw_asset_mutation2]
AS
SELECT        pid, ItemName, ZoneName, BranchName, BranchCode, DivisionName, QTY, Raw_ID, FAID, Period, Value, Value1, PriceVendor, SetDatePayment, Condition, BisUnitName, Date, ZoneID, DivisionID, BranchID
FROM            dbo.vw_asset_mutation
WHERE        (Date <= GETDATE())


GO
/****** Object:  View [dbo].[VW_BUDGET_CAPEX_1]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE VIEW [dbo].[VW_BUDGET_CAPEX_1]
AS
		SELECT  C.BudgetCOA, C.Year, C.BranchID, G.BranchName, C.DivisionID, H.DivisionName,
				CASE WHEN D .STATUS = 0 THEN 
						(SELECT SUM(A.BudgetValue)
						FROM [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
							TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
						WHERE        B.STATUS = 0 AND A.BranchID=1 AND A.Year = C.Year)
					ELSE
						C.BudgetValue 
					END - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year)
					AS BudgetValue,
				CASE WHEN D .STATUS = 0 THEN C.BudgetValue +
					(SELECT        SUM(A.BudgetValue)
					FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
												TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
					WHERE        B.STATUS = 0 AND A.BranchID=1 AND A.DivisionID != 1 AND A.Year = C.Year) -
					(SELECT        SUM(A.BudgetUsed)
					FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
									TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
					WHERE        B.STATUS = 0 AND A.BranchID=1 AND A.Year = C.Year) 
					ELSE C.BudgetValue 
				END - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year) 
					-[dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
					+[dbo].[xfn_Booking_kembali](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
				AS sisa, 

					[dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) AS Budget_booking, 
					'' AS terpakai,
					C.BudgetID,C.Jenis_budget
		FROM            dbo.Mst_Budget AS C LEFT OUTER JOIN
								 dbo.TBL_T_SETTING_BUDGET AS D ON C.Jenis_budget = D.ID_JNS_BUDGET AND C.Year = D.TAHUN LEFT OUTER JOIN
								 dbo.Mst_Branch AS G ON C.BranchID = G.BranchID LEFT OUTER JOIN
								 dbo.Mst_Division AS H ON C.DivisionID = H.DivisionID
		WHERE        (C.DivisionID = 1)
--		WHERE        (C.Year = 2017) AND (C.DivisionID = 1)
--select 100000*31-50000





GO
/****** Object:  View [dbo].[VW_BUDGET_CAPEX_2]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE VIEW [dbo].[VW_BUDGET_CAPEX_2]
AS

SELECT    C.BudgetCOA, C.Year, C.BranchID, G.BranchName, C.DivisionID, H.DivisionName,
		CASE WHEN D.STATUS = 0 THEN 0
			ELSE C.BudgetValue - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year) 
			END AS BudgetValue,
			CASE WHEN D .STATUS = 0 THEN C.BudgetValue +
				(SELECT        SUM(A.BudgetValue)
				FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
											TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
				WHERE        B.STATUS = 0 AND A.BranchID=1 AND A.DivisionID != 1 AND A.Year = C.Year) -
				(SELECT        SUM(A.BudgetUsed)
					FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
												TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
					WHERE        B.STATUS = 0 AND A.BranchID=1 AND A.Year = C.Year) 
				ELSE C.BudgetValue
			END - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year) -- DARI TBL_T_TRANSFER
			-[dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
			+[dbo].[xfn_Booking_kembali](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
			AS sisa,  
			
			[dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) AS Budget_booking, 
			C.BudgetUsed AS terpakai,
 C.BudgetID,C.Jenis_budget
FROM            dbo.Mst_Budget AS C LEFT OUTER JOIN
                         dbo.TBL_T_SETTING_BUDGET AS D ON C.Jenis_budget = D.ID_JNS_BUDGET AND C.Year = D.TAHUN LEFT OUTER JOIN
                         dbo.Mst_Branch AS G ON C.BranchID = G.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS H ON C.DivisionID = H.DivisionID
WHERE        (C.DivisionID IN
                             (SELECT        DivisionID
                               FROM            dbo.Mst_Division
                               WHERE        (BranchID = 1) AND (DivisionID <> 1)))
--WHERE        (C.DivisionID <> 1) AND (C.Jenis_budget = 1) AND (C.Year = 2017)






GO
/****** Object:  View [dbo].[VW_BUDGET_OPEX_1]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE VIEW [dbo].[VW_BUDGET_OPEX_1]
AS

SELECT        C.BudgetCOA, C.Year, C.BranchID, G.BranchName, C.DivisionID, H.DivisionName, 
				CASE WHEN D .STATUS = 0 THEN 
						(SELECT SUM(A.BudgetValue)
						FROM [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
							TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
						WHERE  B.STATUS = 0 AND A.BranchID=77 AND A.Year = C.Year)
					ELSE
						C.BudgetValue 
					END - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year)
					AS BudgetValue,
                         CASE WHEN D .STATUS = 0 THEN C.BudgetValue +
                             (SELECT        SUM(A.BudgetValue)
                               FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
                                                         TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
                               WHERE        B.STATUS = 0 AND A.BranchID = 77 AND A.DivisionID != 77 AND A.Year = C.Year) -
                             (SELECT        SUM(A.BudgetUsed)
                               FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
                                                         TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
                               WHERE        B.STATUS = 0 AND A.BranchID = 77 AND A.Year = C.Year) ELSE C.BudgetValue - C.BudgetUsed 
							   END - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year) 
									-[dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
									+[dbo].[xfn_Booking_kembali](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
							   AS sisa, 
							   
							   [dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) AS Budget_booking, 
                         C.BudgetUsed AS terpakai, C.BudgetID, C.Jenis_budget
FROM            dbo.Mst_Budget AS C LEFT OUTER JOIN
                         dbo.TBL_T_SETTING_BUDGET AS D ON C.Jenis_budget = D.ID_JNS_BUDGET AND C.Year = D.TAHUN LEFT OUTER JOIN
                         dbo.Mst_Branch AS G ON C.BranchID = G.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS H ON C.DivisionID = H.DivisionID
WHERE        (C.DivisionID = 77)




GO
/****** Object:  View [dbo].[VW_BUDGET_OPEX_2]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE VIEW [dbo].[VW_BUDGET_OPEX_2]
AS
SELECT        C.BudgetCOA, C.Year, C.BranchID, G.BranchName, C.DivisionID, H.DivisionName,
			CASE WHEN D.STATUS = 0 THEN 0 
				ELSE C.BudgetValue - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year) 
				END AS BudgetValue, 
                         CASE WHEN D.STATUS = 0 THEN C.BudgetValue +
                             (SELECT        SUM(A.BudgetValue)
                               FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
                                                         TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
                               WHERE        B.STATUS = 0 AND A.BranchID = 77 AND A.DivisionID != 77 AND A.Year = C.Year) -
                             (SELECT        SUM(A.BudgetUsed)
                               FROM            [FAM_V3].[dbo].[Mst_Budget] AS A LEFT JOIN
                                                         TBL_T_SETTING_BUDGET AS B ON A.Jenis_budget = B.ID_JNS_BUDGET
                               WHERE        B.STATUS = 0 AND A.BranchID = 77 AND A.Year = C.Year) ELSE C.BudgetValue 
							   END - dbo.xfn_ASAL(C.DivisionID, C.Year) + dbo.xfn_TUJUAN(C.DivisionID, C.Year) 
									-[dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
									+[dbo].[xfn_Booking_kembali](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) -- DARI TBL_T_TRANS
							   AS sisa, 

							   [dbo].[xfn_Booking](C.Year,C.BranchID,C.DivisionID,C.Jenis_budget) AS Budget_booking, 
							   C.BudgetUsed AS terpakai, C.BudgetID, C.Jenis_budget
FROM            dbo.Mst_Budget AS C LEFT OUTER JOIN
                         dbo.TBL_T_SETTING_BUDGET AS D ON C.Jenis_budget = D.ID_JNS_BUDGET AND C.Year = D.TAHUN LEFT OUTER JOIN
                         dbo.Mst_Branch AS G ON C.BranchID = G.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS H ON C.DivisionID = H.DivisionID
WHERE        (C.DivisionID IN 
                             (SELECT        DivisionID
                               FROM            dbo.Mst_Division
                               WHERE        (BranchID = 77) AND (DivisionID <> 77)))






GO
/****** Object:  View [dbo].[VW_BUDGET]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE VIEW [dbo].[VW_BUDGET]
AS
SELECT * 
FROM [dbo].[VW_BUDGET_CAPEX_1]
UNION ALL
SELECT * 
FROM [dbo].[VW_BUDGET_CAPEX_2]

UNION ALL

SELECT *
FROM [dbo].[VW_BUDGET_OPEX_1]
UNION ALL
SELECT *
FROM [dbo].[VW_BUDGET_OPEX_2]



GO
/****** Object:  View [dbo].[vw_asset_list]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vw_asset_list]
AS
SELECT        SUBSTRING(trx.FAID, 12, 5) AS coa, trx.Status, trx.QTY, trx.Raw_ID, trx.FAID, trx.FAID_lama, trx.Period, trx.PriceVendor, trx.SetDatePayment, trx.Condition, trx.Is_trash, trx.Image, trx.DateCondition, item.ItemName, 
                         zone.ZoneName, br.BranchName, br.BranchCode, div.DivisionName, bis.BisUnitName
FROM            dbo.Trx_DetItemReq AS trx INNER JOIN
                         dbo.Mst_ItemList AS item ON trx.ItemID = item.ItemID INNER JOIN
                         dbo.Mst_Request AS req ON trx.RequestID = req.RequestID INNER JOIN
                         dbo.Mst_Branch AS br ON req.BranchID = br.BranchID INNER JOIN
                         dbo.Mst_Zonasi AS zone ON req.ZoneID = zone.ZoneID LEFT OUTER JOIN
                         dbo.Mst_Division AS div ON req.DivisionID = div.DivisionID LEFT OUTER JOIN
                         dbo.Mst_BisUnit AS bis ON SUBSTRING(trx.FAID, 12, 5) = bis.BisUnitCode
WHERE        (trx.Status IN (9, 3, 2)) AND (trx.StatusLelang = 0) AND (item.AssetType = 'CAPEX') AND (req.ReqTypeID NOT IN (3)) AND (trx.Period IS NOT NULL) AND (trx.Period <> 0) AND (trx.Is_header <> 1)


GO
/****** Object:  View [dbo].[vw_budget_capex_]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE VIEW [dbo].[vw_budget_capex_]
AS
SELECT        
a.BudgetID, 
a.BudgetCOA, 
a.BisUnitID, 
a.Year, 
a.BranchID, 
a.DivisionID, 
a.BudgetOwnID, 
a.BudgetValue, 
a.BudgetUsed, 
a.BudgetValue-a.BudgetUsed as BudgetLeftover,
c.BranchName, 
c.BranchCode, 
d.DivisionName, 
e.BisUnitName,
a.Jenis_budget
FROM            dbo.Mst_Budget AS a LEFT OUTER JOIN
                         dbo.Mst_Branch AS c ON c.BranchID = a.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS d ON d.DivisionID = a.DivisionID LEFT OUTER JOIN
                         dbo.Mst_BisUnit AS e ON e.BisUnitID = a.BisUnitID
WHERE        (a.Is_trash = 0)




GO
/****** Object:  View [dbo].[vw_hps]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE VIEW [dbo].[vw_hps]
AS
SELECT        
hps.HpsID,
convert(varchar(10), hps.StartDate, 105) as StartDate, 
convert(varchar(10), hps.EndDate, 105) as EndDate,   
--format(hps.StartDate, 'dd-MM-yyyy') as StartDate,  
--format(hps.EndDate, 'dd-MM-yyyy') as EndDate,   
CONVERT(varchar, CAST(LTRIM(RTRIM(hps.Price)) AS money), 1) as Price,
--hps.Price, 
item.ItemName, 
zone.ZoneName,
hps.ZoneID
FROM            dbo.Mst_HPS AS hps INNER JOIN
                         dbo.Mst_ItemList AS item ON hps.ItemID = item.ItemID INNER JOIN
                         dbo.Mst_Zonasi AS zone ON hps.ZoneID = zone.ZoneID
WHERE        (hps.Is_trash = 0)





GO
/****** Object:  View [dbo].[vw_opr_inventaris]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[vw_opr_inventaris]
AS
SELECT        
	itemC.ClassCode, 
	req.ReqTypeID, 
	item.ItemName, 
	zone.ZoneName, 
	br.BranchName, 
	br.BranchCode, 
	div.DivisionName, 
	trx.QTY, 
	trx.Raw_ID, 
	trx.Period, 
	trx.PriceVendor, 
	trx.SetDatePayment, 
	trx.FAID, 
	trx.Status,
	trx.Is_trash,
	SUBSTRING(trx.FAID,12,5) as kode_cab,
		case when br.BranchCode=00000 
		then br.BranchName + ' - ' + div.DivisionName 
		else div.DivisionName  + ' => <strong>'+
			case when br.BranchCode=00000 
				THEN (SELECT div.DivisionName 
						FROM Mst_Branch br LEFT JOIN Mst_Division div 
						ON div.BranchID = br.BranchID
						where br.Is_trash=0 AND br.BranchCode=SUBSTRING(trx.FAID,12,5) OR div.DivisionCode=SUBSTRING(trx.FAID,12,5))
				ELSE (SELECT br.BranchName
						FROM Mst_Branch br LEFT JOIN Mst_Division div 
						ON div.BranchID = br.BranchID
						where br.Is_trash=0 AND br.BranchCode=SUBSTRING(trx.FAID,12,5) OR div.DivisionCode=SUBSTRING(trx.FAID,12,5))
			END +'</strong>'
	END AS BranchDivName

FROM            dbo.Trx_DetItemReq AS trx INNER JOIN
                         dbo.Mst_ItemList AS item ON trx.ItemID = item.ItemID INNER JOIN
                         dbo.Mst_Request AS req ON trx.RequestID = req.RequestID INNER JOIN
                         dbo.Mst_Branch AS br ON req.BranchID = br.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS div ON req.DivisionID = div.DivisionID INNER JOIN
                         dbo.Mst_Zonasi AS zone ON req.ZoneID = zone.ZoneID LEFT OUTER JOIN
                         dbo.Mst_ItemClass AS itemC ON item.IClassID = itemC.IClassID
--WHERE        (trx.Is_trash = 0) AND (itemC.ClassCode LIKE '%2%') AND (item.AssetType NOT IN ('CAPEX', 'OPEX')) AND (req.ReqTypeID NOT IN (3)) AND (trx.Is_header <> 1)




GO
/****** Object:  View [dbo].[vw_opr_mutationinventaris]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE VIEW [dbo].[vw_opr_mutationinventaris]
AS
SELECT        
	item.ItemName, 
	zone.ZoneName, 
	br.BranchName, 
	br.BranchCode, 
	unit.BisUnitName, 
	div.DivisionName, 
	trx.QTY, 
	trx.Raw_ID, 
	trx.FAID, 
	trx.Period, 
	trx.PriceVendor, 
	trx.SetDatePayment, 
	trx.Condition,
	case when br.BranchCode=00000 
		then br.BranchName + ' - ' + div.DivisionName 
		else div.DivisionName  + ' => <strong>'+
			case when br.BranchCode=00000 
				THEN (SELECT div.DivisionName 
						FROM Mst_Branch br LEFT JOIN Mst_Division div 
						ON div.BranchID = br.BranchID
						where br.Is_trash=0 AND br.BranchCode=SUBSTRING(trx.FAID,12,5) OR div.DivisionCode=SUBSTRING(trx.FAID,12,5))
				ELSE (SELECT br.BranchName
						FROM Mst_Branch br LEFT JOIN Mst_Division div 
						ON div.BranchID = br.BranchID
						where br.Is_trash=0 AND br.BranchCode=SUBSTRING(trx.FAID,12,5) OR div.DivisionCode=SUBSTRING(trx.FAID,12,5))
			END +'</strong>'
	END AS BranchDivName
FROM            dbo.Trx_DetItemReq AS trx INNER JOIN
                         dbo.Mst_ItemList AS item ON trx.ItemID = item.ItemID INNER JOIN
                         dbo.Mst_Request AS req ON trx.RequestID = req.RequestID INNER JOIN
                         dbo.Mst_Branch AS br ON req.BranchID = br.BranchID LEFT OUTER JOIN
                         dbo.Mst_BisUnit AS unit ON req.BisUnitID = unit.BisUnitID LEFT OUTER JOIN
                         dbo.Mst_Division AS div ON req.DivisionID = div.DivisionID INNER JOIN
                         dbo.Mst_Zonasi AS zone ON req.ZoneID = zone.ZoneID
--WHERE        (trx.Is_trash = 0) AND (trx.Status = 4) AND (trx.StatusLelang = 0) AND (item.AssetType = 'OPEXINVENTARIS')




GO
/****** Object:  View [dbo].[vw_opr_opex]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[vw_opr_opex]
AS
SELECT        item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode, div.DivisionName, trx.QTY, trx.Raw_ID, trx.Period, FORMAT(trx.PriceVendor, 'N2') as PriceVendor, trx.SetDatePayment, trx.Status, type.ReqTypeName, req.RequestID,
req.DivisionID,
req.BranchID

FROM            dbo.Trx_DetItemReq AS trx INNER JOIN
                         dbo.Mst_ItemList AS item ON trx.ItemID = item.ItemID INNER JOIN
                         dbo.Mst_Request AS req ON trx.RequestID = req.RequestID INNER JOIN
                         dbo.Mst_Branch AS br ON req.BranchID = br.BranchID LEFT OUTER JOIN
                         dbo.Mst_Division AS div ON req.DivisionID = div.DivisionID INNER JOIN
                         dbo.Mst_Zonasi AS zone ON req.ZoneID = zone.ZoneID LEFT OUTER JOIN
                         dbo.Mst_RequestType AS type ON req.ReqTypeID = type.ReqTypeID
--WHERE        (trx.Is_trash = 0) AND (trx.Status IN (1, 2)) AND (item.AssetType NOT IN ('CAPEX', 'OPEXINVENTARIS'))



GO
/****** Object:  View [dbo].[vw_pr_itemlist]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE VIEW [dbo].[vw_pr_itemlist]
AS

SELECT NEWID() as pid,c.ItemID, c.ItemName, c.Image, c.AssetType, e.ZoneID, e.ZoneName, d.Price, f.IClassName, g.ItemTypeName
FROM            dbo.Mst_Rkt AS a INNER JOIN
                         dbo.Mst_RequestCategoryDetail AS b ON b.ReqCategoryID = a.ReqCategoryID INNER JOIN
                         dbo.Mst_ItemList AS c ON c.IClassID = b.IClassID INNER JOIN
                         dbo.Mst_HPS AS d ON d.ItemID = c.ItemID INNER JOIN
                         dbo.Mst_Zonasi AS e ON e.ZoneID = d.ZoneID INNER JOIN
                         dbo.Mst_ItemClass AS f ON f.IClassID = c.IClassID INNER JOIN
                         dbo.Mst_ItemType AS g ON g.ItemTypeID = c.ItemTypeID
WHERE        (a.Is_trash = 0) AND (c.Is_trash = 0)

union all 
select 
'DDE68949-D22C-44E0-9BD4-9C29C34FFABEs',
1234,
'komputer',
'daftar-harga-mobil-suzuki.jpg',
'capex',
'1',
'jawa',
'25000000',
'komputer1',
'komputer'







GO
/****** Object:  View [dbo].[vw_pr_out_request]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE VIEW [dbo].[vw_pr_out_request]
AS
SELECT        
a.Direktory_PR, 
a.RequestID, 
ISNULL(e.DivisionCode, f.BranchCode) AS DivisionCode, 
a.DeleteDate, 
a.Is_trash, 
a.Jenis_periode_sewa, 
a.Jangka_waktu, 
a.Termin_sewa,
a.BudgetCOA, 
a.CreateDate, 
a.Status, 
b.ReqCategoryName,
c.ReqTypeName, 
d.EmployeeName, 
e.DivisionName, 
f.BranchCode, 
f.BranchName, 
g.RktName,
replace(ISNULL(c.ReqTypeName,''),' ','')+'-'+ISNULL(b.ReqCategoryName,'')+ '('+ISNULL(g.RktName,'')+')' as param_
FROM            dbo.Mst_Request AS a LEFT OUTER JOIN
                         dbo.Mst_RequestCategory AS b ON a.ReqCategoryID = b.ReqCategoryID LEFT OUTER JOIN
                         dbo.Mst_RequestType AS c ON a.ReqTypeID = c.ReqTypeID LEFT OUTER JOIN
                         dbo.Mst_Employee AS d ON a.CreateBy = d.EmployeeID LEFT OUTER JOIN
                         dbo.Mst_Division AS e ON a.DivisionID = e.DivisionID LEFT OUTER JOIN
                         dbo.Mst_Branch AS f ON a.BranchID = f.BranchID LEFT OUTER JOIN
                         dbo.Mst_Rkt AS g ON a.RktID = g.RktID
WHERE        (a.Is_trash IN (0, 1)) AND (a.Is_Migrasi = 0)




GO
/****** Object:  View [dbo].[vw_pr_termofpayment]    Script Date: 03/09/2018 17.34.26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vw_pr_termofpayment]
AS
SELECT        ISNULL(e.DivisionCode, g.BranchCode) AS DivisionCode, f.VendorID, a.Jenis_periode_sewa, a.Jangka_waktu, a.Termin_sewa, a.PriodSewa, COALESCE (i.num, 0) AS num, a.RequestID, a.BudgetCOA, a.CreateDate, 
                         a.SubTotalPrice, a.PriceVendor, a.Status, a.PathFile, b.ReqCategoryName, c.ReqTypeID, c.ReqTypeName, d.EmployeeName, e.DivisionName, f.VendorName, g.BranchName, h.RktName, a.DivisionID
FROM            dbo.Mst_Request AS a LEFT OUTER JOIN
                         dbo.Mst_RequestCategory AS b ON a.ReqCategoryID = b.ReqCategoryID LEFT OUTER JOIN
                         dbo.Mst_RequestType AS c ON a.ReqTypeID = c.ReqTypeID LEFT OUTER JOIN
                         dbo.Mst_Employee AS d ON a.EmployeeID = d.EmployeeID LEFT OUTER JOIN
                         dbo.Mst_Division AS e ON a.DivisionID = e.DivisionID LEFT OUTER JOIN
                         dbo.Mst_Vendor AS f ON a.VendorID = f.VendorID LEFT OUTER JOIN
                         dbo.Mst_Branch AS g ON a.BranchID = g.BranchID LEFT OUTER JOIN
                         dbo.Mst_Rkt AS h ON a.RktID = h.RktID LEFT OUTER JOIN
                             (SELECT        RequestID, COUNT(RequestID) AS num
                               FROM            dbo.Pay_Termin
                               WHERE        (StatusPayment = 1)
                               GROUP BY RequestID) AS i ON i.RequestID = a.RequestID
WHERE        (a.Is_trash = 0)


GO
ALTER TABLE [dbo].[Mst_BudgetType] ADD  CONSTRAINT [DF_Mst_BudgetType_Is_trash]  DEFAULT ((0)) FOR [Is_trash]
GO
ALTER TABLE [dbo].[Mst_Departement] ADD  CONSTRAINT [DF_Mst_Departement_Is_trash]  DEFAULT ((0)) FOR [Is_trash]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Start__31A25463]  DEFAULT (NULL) FOR [StartDate]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__EndDa__3296789C]  DEFAULT (NULL) FOR [EndDate]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Branc__338A9CD5]  DEFAULT (NULL) FOR [BranchID]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Creat__347EC10E]  DEFAULT (NULL) FOR [CreateDate]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Creat__3572E547]  DEFAULT (NULL) FOR [CreateBy]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Updat__36670980]  DEFAULT (NULL) FOR [UpdateDate]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Updat__375B2DB9]  DEFAULT (NULL) FOR [UpdateBy]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Delet__384F51F2]  DEFAULT (NULL) FOR [DeleteDate]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Delet__3943762B]  DEFAULT (NULL) FOR [DeleteBy]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Is_tr__3A379A64]  DEFAULT ('0') FOR [Is_trash]
GO
ALTER TABLE [dbo].[Mst_HpsHistory] ADD  CONSTRAINT [DF__Mst_HpsHi__Price__3B2BBE9D]  DEFAULT ('0') FOR [Price]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'adad' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'user_id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "trx"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "item"
            Begin Extent = 
               Top = 6
               Left = 252
               Bottom = 136
               Right = 422
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "req"
            Begin Extent = 
               Top = 6
               Left = 460
               Bottom = 136
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "br"
            Begin Extent = 
               Top = 6
               Left = 688
               Bottom = 136
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "zone"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "div"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "bis"
            Begin Extent = 
               Top = 138
               Left = 454
               Bottom = 268
               Right = 628
            End
            DisplayFlags = 280
            TopColumn = 0
  ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_list'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'       End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_list'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_list'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "trx"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "item"
            Begin Extent = 
               Top = 6
               Left = 252
               Bottom = 136
               Right = 422
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "req"
            Begin Extent = 
               Top = 6
               Left = 460
               Bottom = 136
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "br"
            Begin Extent = 
               Top = 6
               Left = 688
               Bottom = 136
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "div"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "zone"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "bis"
            Begin Extent = 
               Top = 138
               Left = 454
               Bottom = 268
               Right = 628
            End
            DisplayFlags = 280
            TopColumn = 0
  ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_mutation'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'       End
         Begin Table = "dep"
            Begin Extent = 
               Top = 138
               Left = 666
               Bottom = 268
               Right = 836
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_mutation'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_mutation'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[21] 2[8] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "vw_asset_mutation"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 21
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_mutation2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_asset_mutation2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 10
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "a"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "c"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "d"
            Begin Extent = 
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "e"
            Begin Extent = 
               Top = 6
               Left = 662
               Bottom = 136
               Right = 836
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_budget_capex_'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_budget_capex_'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "C"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "D"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 453
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "G"
            Begin Extent = 
               Top = 6
               Left = 491
               Bottom = 136
               Right = 661
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "H"
            Begin Extent = 
               Top = 6
               Left = 699
               Bottom = 136
               Right = 869
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_CAPEX_1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_CAPEX_1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "C"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "D"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 453
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "G"
            Begin Extent = 
               Top = 6
               Left = 491
               Bottom = 136
               Right = 661
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "H"
            Begin Extent = 
               Top = 6
               Left = 699
               Bottom = 136
               Right = 869
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_CAPEX_2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_CAPEX_2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "C"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "D"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 453
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "G"
            Begin Extent = 
               Top = 6
               Left = 491
               Bottom = 136
               Right = 661
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "H"
            Begin Extent = 
               Top = 6
               Left = 699
               Bottom = 136
               Right = 869
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_OPEX_1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_OPEX_1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "C"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "D"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 453
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "G"
            Begin Extent = 
               Top = 6
               Left = 491
               Bottom = 136
               Right = 661
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "H"
            Begin Extent = 
               Top = 6
               Left = 699
               Bottom = 136
               Right = 869
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_OPEX_2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW_BUDGET_OPEX_2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "hps"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "item"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "zone"
            Begin Extent = 
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_hps'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_hps'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "trx"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "item"
            Begin Extent = 
               Top = 6
               Left = 252
               Bottom = 136
               Right = 422
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "req"
            Begin Extent = 
               Top = 6
               Left = 460
               Bottom = 136
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "br"
            Begin Extent = 
               Top = 6
               Left = 688
               Bottom = 136
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "div"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "zone"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "itemC"
            Begin Extent = 
               Top = 138
               Left = 454
               Bottom = 268
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_inventaris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_inventaris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_inventaris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "trx"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "item"
            Begin Extent = 
               Top = 6
               Left = 252
               Bottom = 136
               Right = 422
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "req"
            Begin Extent = 
               Top = 6
               Left = 460
               Bottom = 136
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "br"
            Begin Extent = 
               Top = 6
               Left = 688
               Bottom = 136
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "unit"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 212
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "div"
            Begin Extent = 
               Top = 138
               Left = 250
               Bottom = 268
               Right = 420
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "zone"
            Begin Extent = 
               Top = 138
               Left = 458
               Bottom = 268
               Right = 628
            End
            DisplayFlags = 280
            TopColumn = 0
 ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_mutationinventaris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'        End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_mutationinventaris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_mutationinventaris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[21] 2[33] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "trx"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "item"
            Begin Extent = 
               Top = 6
               Left = 252
               Bottom = 136
               Right = 422
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "req"
            Begin Extent = 
               Top = 6
               Left = 460
               Bottom = 136
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "br"
            Begin Extent = 
               Top = 6
               Left = 688
               Bottom = 136
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "div"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "zone"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "type"
            Begin Extent = 
               Top = 138
               Left = 454
               Bottom = 251
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
 ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_opex'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'        End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 14
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_opex'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_opr_opex'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "a"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "b"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 136
               Right = 419
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "c"
            Begin Extent = 
               Top = 6
               Left = 457
               Bottom = 136
               Right = 627
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "d"
            Begin Extent = 
               Top = 6
               Left = 665
               Bottom = 136
               Right = 835
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "e"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "f"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "g"
            Begin Extent = 
               Top = 138
               Left = 454
               Bottom = 268
               Right = 625
            End
            DisplayFlags = 280
            TopColumn = 0
         End
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_itemlist'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'   End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 10
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_itemlist'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_itemlist'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "a"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 228
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "b"
            Begin Extent = 
               Top = 6
               Left = 266
               Bottom = 136
               Right = 455
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "c"
            Begin Extent = 
               Top = 6
               Left = 493
               Bottom = 119
               Right = 663
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "d"
            Begin Extent = 
               Top = 6
               Left = 701
               Bottom = 136
               Right = 882
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "e"
            Begin Extent = 
               Top = 120
               Left = 493
               Bottom = 250
               Right = 663
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "f"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "g"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_out_request'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'   End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_out_request'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_out_request'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "a"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 173
               Right = 228
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "b"
            Begin Extent = 
               Top = 6
               Left = 266
               Bottom = 136
               Right = 455
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "c"
            Begin Extent = 
               Top = 6
               Left = 493
               Bottom = 119
               Right = 663
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "d"
            Begin Extent = 
               Top = 6
               Left = 701
               Bottom = 136
               Right = 882
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "e"
            Begin Extent = 
               Top = 120
               Left = 493
               Bottom = 250
               Right = 663
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "f"
            Begin Extent = 
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "g"
            Begin Extent = 
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_termofpayment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'      Begin Table = "h"
            Begin Extent = 
               Top = 138
               Left = 701
               Bottom = 268
               Right = 871
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "i"
            Begin Extent = 
               Top = 252
               Left = 454
               Bottom = 348
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_termofpayment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_pr_termofpayment'
GO
