import React, { useEffect, useState } from "react";
import MaterialTable from "material-table";
import useAxios from "axios-hooks";

import { forwardRef } from 'react';

import ChevronLeft from '@material-ui/icons/ChevronLeft';
import ChevronRight from '@material-ui/icons/ChevronRight';
import FirstPage from '@material-ui/icons/FirstPage';
import LastPage from '@material-ui/icons/LastPage';
import ArrowDownward from '@material-ui/icons/ArrowDownward';

const tableIcons = {
    FirstPage: forwardRef((props, ref) => <FirstPage {...props} ref={ref} />),
    LastPage: forwardRef((props, ref) => <LastPage {...props} ref={ref} />),
    NextPage: forwardRef((props, ref) => <ChevronRight {...props} ref={ref} />),
    PreviousPage: forwardRef((props, ref) => <ChevronLeft {...props} ref={ref} />),
    SortArrow: forwardRef((props, ref) => <ArrowDownward {...props} ref={ref} />),
};

const FilmsTable = () => {
    const [items, setItems] = useState([]);
    const [{ data = {}, loading }, fetch] = useAxios(
        `http://localhost/api/films`,
        { manual: true }
    );

    const columns = [
        { title: "Title", field: "title" },
        { title: "EpisodeId", field: "episodeId" },
        { title: "Opening Crawl", field: "openingCrawl", render: rowData => rowData.openingCrawl.substring(0, 100) + '...' },
        { title: "Director", field: "director" },
        { title: "Producer", field: "producer" },
        { title: "Release Date", field: "releaseDate" },
        { title: "Url", field: "url" },
    ];

    useEffect(() => {
        fetch();
    }, [fetch]);

    useEffect(() => {
        if (!loading && Array.isArray(data)) {
            setItems(data);
        }
    }, [loading, setItems, data]);

    return (
        <div className="mt-lg-5 table-responsive-sm">
            <MaterialTable
                title="Star Wars Movies"
                data={items}
                columns={columns}
                options={{
                    debounceInterval: 500,
                    paging: true,
                    search: false,
                }}
                isLoading={loading}
                icons={tableIcons}
            />
        </div>
    );
};

export default FilmsTable;
